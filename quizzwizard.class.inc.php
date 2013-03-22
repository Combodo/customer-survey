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
	protected $oSurveyTargetAnswer;
	protected $oSurvey;
	
	public function __construct($sInitialStepClass, $sInitialState = '', $iQuizzId = 0, $sToken = '')
	{
		parent::__construct($sInitialStepClass, $sInitialState);
		$this->oSurveyTargetAnswer = null;
		$this->oSurvey = null;
		if ($sToken != '')
		{			
			$oTargetSearch = DBObjectSearch::FromOQL_AllData("SELECT SurveyTargetAnswer WHERE token = :token");
			$oTargetSet = new CMDBObjectSet($oTargetSearch, array(), array('token' => $sToken));
			if ($oTargetSet->Count() == 0)
			{
				throw new UnknownTokenException($sToken);
			}
			$this->oSurveyTargetAnswer = $oTargetSet->Fetch();
			$this->oSurvey = MetaModel::GetObject('Survey', $this->oSurveyTargetAnswer->Get('survey_id'), true, true /*allow all data*/);
			$this->oQuizz = MetaModel::GetObject('Quizz', $this->oSurvey->Get('quizz_id'), true, true /*allow all data*/);
		}
		else
		{
			$this->oQuizz = MetaModel::GetObject('Quizz', $iQuizzId);
		}
	}
	
	public function GetQuizz()
	{
		return $this->oQuizz;
	}
	
	public function GetSurveyTargetAnswer()
	{
		return $this->oSurveyTargetAnswer;
	}
	
	public function GetSurvey()
	{
		return $this->oSurvey;
	}
	
	/**
	 * Displays the specified 'step' of the wizard
	 * @param WizardStep $oStep The 'step' to display
	 */
	protected function DisplayStep(WizardStep $oStep)
	{
		$oPage = new QuizzWebPage($oStep->GetTitle());

		$oPage->add_linked_script(utils::GetAbsoluteUrlModulesRoot().'customer-survey/js/quizzwizard.js');
		$oPage->add_script("function CanMoveForward()\n{\n".$oStep->JSCanMoveForward()."\n}\n");
		$oPage->add_script("function CanMoveBackward()\n{\n".$oStep->JSCanMoveBackward()."\n}\n");
		$iQuizz = $this->GetQuizz()->GetKey();
		$sTargetAnswer = '';
		if ($this->GetSurveyTargetAnswer())
		{
			$sToken = addslashes($this->GetSurveyTargetAnswer()->Get('token'));
		}
		$oPage->add_script(
<<<EOF
var iQuizz = $iQuizz;
var sToken = '$sToken';

EOF
		);
		$oPage->add_ready_script(
<<<EOF
$('div.question input[type=radio]').bind('click change', function() { WizardUpdateButtons(); });
$('div.question textarea').bind('keyup change', function() { WizardUpdateButtons(); });
EOF
		);
		
		if ($this->oSurveyTargetAnswer == null)
		{
			$oPage->add('<div class="preview_watermark">'.Dict::S('Survery-Preview Mode').'</div>');
		}
		$oPage->add('<form id="wiz_form" method="post">');
		$oStep->Display($oPage);
		
		// Add the back / next buttons and the hidden form
		// to store the parameters
		$oPage->add('<input type="hidden" id="_class" name="_class" value="'.get_class($oStep).'"/>');
		$oPage->add('<input type="hidden" id="_state" name="_state" value="'.$oStep->GetState().'"/>');
		foreach($this->aParameters as $sCode => $value)
		{
			$oPage->add('<input type="hidden" id="_params_'.$sCode.'" name="_params['.$sCode.']" value="'.htmlentities($value, ENT_QUOTES, 'UTF-8').'"/>');
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
$('#btn_suspend').click(function() { Suspend(); });

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
		
	/**
	 * Move one step back: OVERLOADED/ REDEFINED to workaround a bug in iTop 2.0
	 * ProcessParams was not called with false as an argument, thus making no difference
	 * between moving back and forward !!
	 */
	protected function Back()
	{
		// let the current step save its parameters
		$sCurrentStepClass = utils::ReadParam('_class', $this->sInitialStepClass);
		$sCurrentState = utils::ReadParam('_state', $this->sInitialState);
		$oStep = new $sCurrentStepClass($this, $sCurrentState);
		$aNextStepInfo = $oStep->ProcessParams(false); // false => Moving backwards
		
		// Display the previous step
		$aCurrentStepInfo = $this->PopStep();
		$oStep = new $aCurrentStepInfo['class']($this, $aCurrentStepInfo['state']);
		$this->DisplayStep($oStep);
	}
}

class QuizzWizStepQuestions extends WizardStep
{
	protected $aQuestions;
	protected $aPages;
	protected $bAnswerCommitted;
	protected $bSurveyFinished;
	
	public function __construct($oWizard, $sCurrentState)
	{
		parent::__construct($oWizard, $sCurrentState);
		
		$oQuizz = $oWizard->GetQuizz();
		$oQuestionsSet = $oQuizz->Get('question_list');
		
		$this->bSurveyFinished = false;
		$this->bAnswerCommitted = false;
		$oSurveyTargetAnswer = $this->oWizard->GetSurveyTargetAnswer();
		
		if ($oSurveyTargetAnswer != null)
		{
			// A real survey is under way... or is it ?
			if ($oSurveyTargetAnswer->Get('status') == 'finished')
			{
				$this->bAnswerCommitted = true;
			}
			$oSurvey = $this->oWizard->GetSurvey();
			if ($oSurvey->Get('status') == 'closed')
			{
				$this->bSurveyFinished = true;
			}
		}
		
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
		if ($this->bSurveyFinished || $this->bAnswerCommitted)
		{
			// Should never happen... but just in case someone tweaks the form
			throw new Exception("Survey closed or already completed, not accepting answers anymore");
		}
		
		$index = $this->GetStepIndex();		
		$aQuestions = $this->GetStepQuestions($index);
		if ( $aQuestions == null)
		{
			throw new Exception('Internal error: invalid step "'.$index.'" for quizz.');
		}
		else if ($bMoveForward)
		{
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
				$oSurveyTargetAnswer = $this->oWizard->GetSurveyTargetAnswer();
				if ($oSurveyTargetAnswer != null)
				{
					// Save the values, mark the survey as "finished" and call the trigger
					$this->SubmitAnswers($oSurveyTargetAnswer, $aAnswers, true /* bFinished */);
					
					$oSurvey = $this->oWizard->GetSurvey();
					
					if ($oSurvey != null)
					{
						if ($oSurvey->Get('email_on_completion') == 'yes')
						{
							$oContact = MetaModel::GetObject('Contact', $oSurvey->Get('on_behalf_of'), false);
							if ($oContact && ($oContact->Get('email') != ''))
							{
								// Send a notification to the person "on behalf"
								$oEmail = new EMail();
								if ($oSurvey->IsAnonymous())
								{
									$oEmail->SetSubject(Dict::Format('Survey-CompletionNotification_name', $oSurvey->GetName()));
									$sSurveyUrl = ApplicationContext::MakeObjectUrl('Survey', $oSurvey->GetKey(), null, false);
									$sBody = Dict::Format('Survey-CompletionNotificationBody_url', $sSurveyUrl);
								}
								else
								{
									$oEmail->SetSubject(Dict::Format('Survey-CompletionNotification_name_contact', $oSurvey->GetName(), $oContact->GetName()));
									$sSurveyUrl = ApplicationContext::MakeObjectUrl('Survey', $oSurvey->GetKey(), null, false);
									$sBody = Dict::Format('Survey-CompletionNotificationBody_url_contact', $sSurveyUrl, $oContact->GetName());
								}
								$oEmail->SetBody($sBody);
								$oEmail->SetRecipientTO($oContact->Get('email'));
								$oEmail->SetRecipientFrom($oContact->Get('email'));
								$aIssues = array();
								$iRes = $oEmail->Send($aIssues);
								switch ($iRes)
								{
									case EMAIL_SEND_ERROR:
									IssueLog::Error("Failed to send email on survey completion. Errors: ".implode(', ', $aErrors));					
								}													
							}
						}
					}
				}
				// Move to the next step
				return array('class' => 'QuizzWizStepDone', 'state' => '');
			}
		}
		else
		{
			// Moving backwards, save the previous' page values
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
		}
	}
	
	public function Display(WebPage $oPage)
	{
		if ($this->bSurveyFinished)
		{
			$oPage->p(Dict::S('Survey-SurveyFinished'));
			// Hide the buttons
			$oPage->add_ready_script("$('#btn_suspend').hide(); $('#btn_next').hide();");
		}
		else if ($this->bAnswerCommitted)
		{
			$oPage->p(Dict::S('Survey-AnswerAlreadyCommitted'));
			// Hide the buttons
			$oPage->add_ready_script("$('#btn_suspend').hide(); $('#btn_next').hide();");
		}
		else
		{
			$this->DisplayStep($oPage);
		}
	}
	
	protected function DisplayStep($oPage)
	{
		$index = $this->GetStepIndex();
		$aQuestions = $this->GetStepQuestions($index);

		// Check for any previous answer
		$aPreviousAnswers = array();
		$oSurveyTargetAnswer = $this->oWizard->GetSurveyTargetAnswer();
		if ($oSurveyTargetAnswer != null)
		{
			$sOQL = "SELECT SurveyAnswer AS A WHERE A.survey_target_id = :id";
			$oAnswerSet = new DBObjectSet(DBObjectSearch::FromOQL($sOQL, array('id' => $oSurveyTargetAnswer->GetKey())));
			while($oAnswer = $oAnswerSet->Fetch())
			{
				$aPreviousAnswers[$oAnswer->Get('question_id')] = $oAnswer; 
			}
		}
		
		// Build the form
		//
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
			$sSavedValue = '';
			if (isset($aPreviousAnswers[$oQuestion->GetKey()]))
			{
				// Retrieve the previously saved values (via the "suspend" function)
				$sSavedValue = $aPreviousAnswers[$oQuestion->GetKey()]->Get('value');
			}
			$sAnswer = isset($aAnswers[$oQuestion->GetKey()]) ? $aAnswers[$oQuestion->GetKey()] : $sSavedValue;
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
		if ($this->bSurveyFinished || $this->bAnswerCommitted)
		{
			return "return false";
		}
		else
		{
			return "return CheckMandatoryAnswers();";
		}
	}
	
	function SubmitAnswers($oSurveyTargetAnswer, $aAnswers, $bFinished = true, $iLastQuestionId = 0)
	{
		$oQuestionSearch = DBObjectSearch::FromOQL_AllData("SELECT QuizzElement WHERE quizz_id = :Quizz");
		$oQuestionSet = new CMDBObjectSet($oQuestionSearch, array('order' => true), array('Quizz' => $this->oWizard->GetQuizz()->GetKey()));
		if ($oQuestionSet->Count() == 0)
		{
			throw new Exception("Sorry, there is no question for this Quizz (?!)");
		}
		
		// Check for any previous answer
		$sOQL = "SELECT SurveyAnswer AS A WHERE A.survey_target_id = :id";
		$oAnswerSet = new DBObjectSet(DBObjectSearch::FromOQL($sOQL, array('id' => $oSurveyTargetAnswer->GetKey())));
		$aPreviousAnswers = array();
		while($oAnswer = $oAnswerSet->Fetch())
		{
			$aPreviousAnswers[$oAnswer->Get('question_id')] = $oAnswer; 
		}
	
		// For each question, retrieve the answer and store it
		//
		while($oQuestion = $oQuestionSet->Fetch())
		{
			$iQuestion = $oQuestion->GetKey();
			
			if ($oQuestion->HasValue() && isset($aAnswers[$iQuestion]))
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
					$oAnswer->Set('survey_target_id', $oSurveyTargetAnswer->GetKey());
					$oAnswer->Set('question_id', $iQuestion);
				}
				$oAnswer->Set('value', $oQuestion->ValidateValue($aAnswers[$iQuestion]));
				$oAnswer->DBWrite();
			}
		}
	
		// Update the target record
		//
		$oSurveyTargetAnswer->Set('date_response', time());
		$oSurveyTargetAnswer->Set('status', $bFinished ? 'finished' : 'ongoing');
		$oSurveyTargetAnswer->Set('last_question_id', $bFinished ? null : $iLastQuestionId);
		$oSurveyTargetAnswer->DBUpdate();
	}	

	/**
	 * Overload this function to implement asynchronous action(s) (AJAX)
	 * @param string $sCode The code of the action (if several actions need to be distinguished)
	 * @param hash $aParameters The action's parameters name => value
	 */
	public function AsyncAction(WebPage $oPage, $sCode, $aParameters)
	{
		switch($sCode)
		{
			case 'suspend':
			$oSurveyTargetAnswer = $this->oWizard->GetSurveyTargetAnswer();
			if ($oSurveyTargetAnswer != null)
			{
				$iLastQuestionId = 0;
				$aAnswers = array();
				// Values from other pages (or previous values from the current page)
				$aValues = json_decode(isset($aParameters['other_answers']) ? $aParameters['other_answers'] : '[]', true);
				foreach($aValues as $sKey => $sValue)
				{
					$iQuestionId = (int)$sKey;
					$iLastQuestionId = max($iLastQuestionId, $iQuestionId);
					$aAnswers[$iQuestionId] = trim($sValue);
				}
				
				// Values from the current page
				foreach($aParameters as $sKey => $sValue)
				{
					if (preg_match('/^answer\[([0-9]+)$/', $sKey, $aMatches))
					{
						$iQuestionId = (int)$aMatches[1];
						$iLastQuestionId = max($iLastQuestionId, $iQuestionId);
						$aAnswers[$iQuestionId] = trim($sValue);
					}
				}
				if ($iLastQuestionId > 0)
				{
					// Save the current state but don't mark the survey answer as finished
					$this->SubmitAnswers($oSurveyTargetAnswer, $aAnswers, false, $iLastQuestionId);
				}
			}
		}
	}
}

class QuizzWizStepDone extends WizardStep
{
	public function GetTitle()
	{
		$sTitle = Dict::S('Survey-SurveyCompleted-Title');
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
		$oPage->p(Dict::S('Survey-SurveyCompleted-Text'));
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
