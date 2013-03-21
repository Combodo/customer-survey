<?php
require_once(APPROOT.'setup/wizardcontroller.class.inc.php');

class UnknownTokenException extends Exception
{
	protected $m_sToken;
	public function __construct($sToken)
	{
		parent::__construct('Unknown token or closed survey: '.$sToken);
		$this->m_sToken = $sToken;
	}
	public function GetToken()
	{
		return $this->m_sToken;
	}
}

class QuizzController extends WizardController
{
	protected $oQuizz;
	
	public function __construct($sInitialStepClass, $sInitialState = '', $iQuizzId = 0)
	{
		parent::__construct($sInitialStepClass, $sInitialState);
		$this->oQuizz = MetaModel::GetObject('Quizz', $iQuizzId);
	}
	
	public function GetQuizz()
	{
		return $this->oQuizz;
	}
	
	/**
	 * Displays the specified 'step' of the wizard
	 * @param WizardStep $oStep The 'step' to display
	 */
	protected function DisplayStep(WizardStep $oStep)
	{
		$oPage = new QuizzWebPage($oStep->GetTitle());

		$oPage->add_linked_script('../setup/setup.js');
		$oPage->add_script("function CanMoveForward()\n{\n".$oStep->JSCanMoveForward()."\n}\n");
		$oPage->add_script("function CanMoveBackward()\n{\n".$oStep->JSCanMoveBackward()."\n}\n");
		$oPage->add_script(
<<<EOF
function CheckMandatoryAnswers()
{
	bReturn = true;
	
	$('div[data-mandatory=true]').each(function() {
		
		var oRadios = $(this).find('input[type=radio]');
		
		if (oRadios.length > 0)
		{
			if ($(this).find('input[type=radio]:checked').length == 0)
			{
				bReturn = false;
			}
		}
		else
		{
			oText = $(this).find('textarea');
			
			if (oText.val() == '')
			{
				bReturn = false;
			}
		}
	});
	
	return bReturn;
}
EOF
		);
		$oPage->add_ready_script(
<<<EOF
$('div.question input[type=radio]').bind('click change', function() { WizardUpdateButtons(); });
$('div.question textarea').bind('keyup change', function() { WizardUpdateButtons(); });
EOF
		);
		
		$oPage->add('<form id="wiz_form" method="post">');
		$oStep->Display($oPage);
		
		// Add the back / next buttons and the hidden form
		// to store the parameters
		$oPage->add('<input type="hidden" id="_class" name="_class" value="'.get_class($oStep).'"/>');
		$oPage->add('<input type="hidden" id="_state" name="_state" value="'.$oStep->GetState().'"/>');
		foreach($this->aParameters as $sCode => $value)
		{
			$oPage->add('<input type="hidden" name="_params['.$sCode.']" value="'.htmlentities($value, ENT_QUOTES, 'UTF-8').'"/>');
		}

		$oPage->add('<input type="hidden" name="_steps" value="'.htmlentities(json_encode($this->aSteps), ENT_QUOTES, 'UTF-8').'"/>');
		$sBackButton = '';
		if ((count($this->aSteps) > 0) && ($oStep->CanMoveBackward()))
		{
			$sBackButton = '<button id="btn_back" type="submit" name="operation" value="back"> &lt;&lt; Back </button>'; // TODO: localize
		}
		$sNextButtons = '';
		if ($oStep->CanMoveForward())
		{	
			$sNextButtons .= '<button id="btn_suspend" class="default" type="button" name="suspend" value="suspend">'.htmlentities(Dict::S('Survey-SuspendButton'), ENT_QUOTES, 'UTF-8').'</button>';
			$sNextButtons .= '<button id="btn_next" class="default" type="submit" name="operation" value="next">'.htmlentities($oStep->GetNextButtonLabel(), ENT_QUOTES, 'UTF-8').'</button>';
		}
		$oPage->add('<table style="width:100%;"><tr>');
		$oPage->add('<td style="text-align: left">'.$sBackButton.'</td>');
		$oPage->add('<td style="text-align: right">'.$sNextButtons.'</td>');
		$oPage->add('</tr></table>');
		$oPage->add("</form>");
		$oPage->add('<div id="async_action" style="display:none;overflow:auto;max-height:100px;color:#F00;font-size:small;"></div>'); // The div may become visible in case of error

		// Hack to have the "Next >>" button, be the default button, since the first submit button in the form is the default one
		$oPage->add_ready_script(
<<<EOF

$('form').each(function () {
	var thisform = $(this);
		thisform.prepend(thisform.find('button.default').clone().removeAttr('id').removeAttr('disabled').css({
		position: 'absolute',
		left: '-999px',
		top: '-999px',
		height: 0,
		width: 0
	}));
});
$('#btn_back').click(function() { $('#wiz_form').data('back', true); });

$('#wiz_form').submit(function() {
	if ($(this).data('back'))
	{
		return CanMoveBackward();
	}
	else
	{
		return CanMoveForward();
	} 
});

$('#wiz_form').data('back', false);
WizardUpdateButtons();

EOF
		);
		$oPage->output();
	}	
}

class QuizzWizStepQuestions extends WizardStep
{
	protected $aQuestions;
	protected $aPages;
	
	public function __construct($oWizard, $sCurrentState)
	{
		parent::__construct($oWizard, $sCurrentState);
		
		$oQuizz = $oWizard->GetQuizz();
		$oQuestionsSet = $oQuizz->Get('question_list');
		
		$this->aQuestions = array(0 => array());
		$this->aPages = array(0 => 'default');
		$iPage = 0;
		while($oQuestion = $oQuestionsSet->Fetch())
		{
			if ($oQuestion->IsNewPage())
			{
				// Start a new page, only if there are some actual questions on the previous page
				// (skip empty pages)
				if (count($this->aQuestions[$iPage]) > 0)
				{
					$iPage++;
				}
				$this->aPages[$iPage] = $oQuestion;
				$this->aQuestions[$iPage] = array();
			}
			else
			{
				$this->aQuestions[$iPage][] = $oQuestion;
			}
		}		
	}
	
	public function GetTitle()
	{
		return $this->oWizard->GetQuizz()->GetAsHtml('title');
	}
	
	public function GetPossibleSteps()
	{
		return array('QuizzWizStepQuestions', 'QuizzWizStepDone');
	}
	
	public function ProcessParams($bMoveForward = true)
	{
		$index = $this->GetStepIndex();		
		$aQuestions = $this->GetStepQuestions($index);
		if ( $aQuestions == null)
		{
			throw new Exception('Internal error: invalid step "'.$index.'" for quizz.');
		}
		else if ($bMoveForward)
		{
			if ($index == 0)
			{
				// Very first page of the wizard, save the token for later
				$this->oWizard->SaveParameter('token', '');
			}
			// Save the "answers"
			$aPageAnswers = utils::ReadPostedParam('answer', array(), 'raw_data');
			$aAnswers = json_decode($this->oWizard->GetParameter('answer', '[]'), true);
			foreach($aQuestions as $oQuestion)
			{
				if ($oQuestion->HasValue())
				{
					$aAnswers[$oQuestion->GetKey()] = $oQuestion->ValidateValue(isset($aPageAnswers[$oQuestion->GetKey()]) ? $aPageAnswers[$oQuestion->GetKey()] : '');
				}
			}
			$this->oWizard->SetParameter('answer', json_encode($aAnswers));
			if ($this->GetStepQuestions(1 + $index) != null)
			{
				return array('class' => 'QuizzWizStepQuestions', 'state' => (1+$index));
			}
			else
			{
				// Save the values, mark the survey as "finished" and call the trigger
				// Move to the next step
				return array('class' => 'QuizzWizStepDone', 'state' => '');
			}
		}
	}
	
	public function Display(WebPage $oPage)
	{
		$this->DisplayStep($oPage);
	}
	
	protected function DisplayStep($oPage)
	{
		$index = $this->GetStepIndex();
		$aQuestions = $this->GetStepQuestions($index);

		// Build the form
		//
		//$oPage->add("<h1>".$this->GetAsHtml('title')."</h1>\n");
		//$oPage->add("<p>".$this->GetAsHtml('introduction')."</p>\n");
		if ($index ==0)
		{
			$sTitle = $this->oWizard->GetQuizz()->GetAsHtml('title');
			$sDescription = $this->oWizard->GetQuizz()->GetAsHtml('introduction');	
		}
		else
		{
			$question = $this->GetStepInfo($index);
			if ($question == 'default')
			{
				// No title for the first page, let's use a default value
				$sTitle = Dict::S('Survey-DefaultTitle');
				$sDescription = '';
			}
			else
			{
				$sTitle = $question->GetAsHTML('title');
				$sDescription = $question->GetAsHTML('description');
			}
		}	
		$oPage->add("<h1>$sTitle</h1>\n");
		$oPage->add("<p>$sDescription</p>\n");	
		$oPage->add("<div class=\"wizContainer\">\n");
/*	
		if ($oTarget)
		{
			$sToken = $oTarget->Get('token');
			$oPage->add("<input type=\"hidden\" name=\"token\" value=\"$sToken\">");
		}
*/
		$bHasMandatoryQuestions = false;
		$aAnswers = json_decode($this->oWizard->GetParameter('answer'), true);
		foreach($aQuestions as $oQuestion)
		{
			$sMandatory = 'false';
			if ($oQuestion->Get('mandatory') == 'yes')
			{
				$bHasMandatoryQuestions = true;
				$sMandatory = 'true';
			}
			$oPage->add('<div class="question" data-mandatory="'.$sMandatory.'">');
			//TODO: retrieve the previously saved values (via the "suspend" function)
			$sAnswer = isset($aAnswers[$oQuestion->GetKey()]) ? $aAnswers[$oQuestion->GetKey()] : '';
			$oQuestion->DisplayForm($oPage, $sAnswer); 
			$oPage->add('</div>');
		}
	
		$oPage->add("</div>");
		if ($bHasMandatoryQuestions)
		{		
			$oPage->p("<span class=\"mandatory_asterisk\">*</span> ".Dict::S('Survey-MandatoryQuestion'));
		}
	}
	
	protected function GetStepIndex()
	{
		switch($this->sCurrentState)
		{
			case 'start':
			$index = 0;
			break;
			
			default:
			$index = (integer)$this->sCurrentState;
		}
		return $index;
	}
	
	protected function GetStepQuestions($idx)
	{		
		$iPage = 0;
		if (array_key_exists($idx, $this->aQuestions))
		{
			return $this->aQuestions[$idx];
		}
		return null;
	}
	
	
	protected function GetStepInfo($idx)
	{		
		$iPage = 0;
		if (array_key_exists($idx, $this->aPages))
		{
			return $this->aPages[$idx];
		}
		return null;
	}
	
	public function GetNextButtonLabel()
	{
		if ($this->GetStepQuestions(1 + $this->GetStepIndex()) == null)
		{
			return "Finish";
		}
		else
		{
			return parent::GetNextButtonLabel();
		}
	}
	
	public function JSCanMoveForward()
	{
		return "return CheckMandatoryAnswers();";
	}
	
	function GetContext($sToken)
	{
		$sToken = $this->oWizard->GetParameter('token');
		// Find the corresponding survey target -> survey -> Quizz
		//
		$oTargetSearch = DBObjectSearch::FromOQL_AllData("SELECT SurveyTargetAnswer WHERE token = :token");
		$oTargetSet = new CMDBObjectSet($oTargetSearch, array(), array('token' => $sToken));
		if ($oTargetSet->Count() == 0)
		{
			throw new UnknownTokenException($sToken);
		}
		$oTarget = $oTargetSet->Fetch();
		$oSurvey = MetaModel::GetObject('Survey', $oTarget->Get('survey_id'), true, true /*allow all data*/);
		$oQuizz = MetaModel::GetObject('Quizz', $oSurvey->Get('quizz_id'), true, true /*allow all data*/);
	
	  	// Find the questions
		//
		$oQuestionSearch = DBObjectSearch::FromOQL_AllData("SELECT QuizzQuestion WHERE quizz_id = :Quizz");
		$oQuestionSet = new CMDBObjectSet($oQuestionSearch, array('order' => true), array('Quizz' => $oQuizz->GetKey()));
		if ($oQuestionSet->Count() == 0)
		{
			throw new Exception("Sorry, there is no question for this Quizz (?!)");
		}
	
		// Set the current language to the language of the survey
		$oQuizz->ChangeDictionnaryLanguage();
	
		return array($oTarget, $oSurvey, $oQuizz, $oQuestionSet);
	}
	
	function SubmitAnswers($sToken, $aAnswers, $bFinished = true)
	{
		list($oTarget, $oSurvey, $oQuizz, $oQuestionSet) = GetContext($sToken);
		
		// Check for any previous answer
		$sOQL = "SELECT SurveyAnswer AS A JOIN SurveyTargetAnswer AS T ON A.survey_target_id = T.id WHERE T.token = :token";
		$oAnswerSet = new DBObjectSet(DBObjectSearch::FromOQL($sOQL, array('token' => $sToken)));
		$aPreviousAnswers = array();
		while($oAnswer = $oAnswerSet->Fetch())
		{
			$aPreviousAnswers[$oAnswer->Get('question_id')] = $oAnswer; 
		}
	
		// Foreach question, find the answer
		//
		while($oQuestion = $oQuestionSet->Fetch())
		{
			$iQuestion = $oQuestion->GetKey();
			
			if (isset($aAnswers[$iQuestion]))
			{
				if (isset($aPreviousAnswers[$iQuestion]))
				{
					// Update the previous answer
					$oAnswer = $aPreviousAnswers[$iQuestion];
				}
				else
				{
					// Create a new record
					$oAnswer = new SurveyAnswer();
					$oAnswer->Set('survey_target_id', $oTarget->GetKey());
					$oAnswer->Set('question_id', $iQuestion);
				}
				$oAnswer->Set('value', $aAnswers[$iQuestion]);
				$oAnswer->DBWrite();
			}
		}
	
		// Update the target record
		//
		$oTarget->Set('date_response', time());
		$oTarget->Set('status', $bFinished ? 'finished' : 'ongoing');
		$oTarget->DBUpdate();
	
		$oP->add("<p>".Dict::S('Survey-form-done')."</p>\n");
		$oP->add("<p>".Dict::S('Survey-form-thankyou')."</p>\n");
	}	
}

class QuizzWizStepDone extends WizardStep
{
	public function GetTitle()
	{
		$sTitle = 'TBD';
		return $sTitle;
	}
	
	public function GetPossibleSteps()
	{
		return array();
	}
	
	public function ProcessParams($bMoveForward = true)
	{
		
	}
	
	public function Display(WebPage $oPage)
	{
		$oPage->p('Done !');
	}
	
	public function CanMoveForward()
	{
		return false;
	}
	public function CanMoveBackward()
	{
		return false;
	}
}
