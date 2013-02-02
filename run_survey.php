<?php
// Copyright (C) 2010 Combodo SARL
//
//   This program is free software; you can redistribute it and/or modify
//   it under the terms of the GNU General Public License as published by
//   the Free Software Foundation; version 3 of the License.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of the GNU General Public License
//   along with this program; if not, write to the Free Software
//   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

/**
 * iTop User Portal main page
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */
require_once('../../approot.inc.php');
require_once(APPROOT.'/application/application.inc.php');
require_once(APPROOT.'/application/nicewebpage.class.inc.php');
require_once(APPROOT.'/application/wizardhelper.class.inc.php');

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

function ReadMandatoryParam($sParam, $sSanitizationFilter = 'parameter')
{
	$value = utils::ReadParam($sParam, null, false /*allow CLI*/, $sSanitizationFilter);
	if (is_null($value))
	{
		throw new Exception("Missing argument '$sParam'");
	}
	return $value; 
}


function GetContext($sToken)
{
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


function ShowDraftQuizz($oP, $iQuizz)
{
	$oQuizz = MetaModel::GetObject('Quizz', $iQuizz, false, true /*allow all data*/);
	if ($oQuizz)
	{
		// Set the current language to the language of the survey
		$oQuizz->ChangeDictionnaryLanguage();

		$oP->set_title(Dict::S('Survey-Title-Draft'));
		$oQuizz->ShowForm($oP);
	}
	else
	{
		$oP->p("Invalid value for quizz_id: '$iQuizz'");
	}
}

function ShowQuizz($oP, $sToken)
{
	try
	{
		list($oTarget, $oSurvey, $oQuizz, $oQuestionSet) = GetContext($sToken);
		$oP->set_title(Dict::S('Survey-Title'));

		if (strlen($oTarget->Get('date_response')) > 0)
		{
			$oP->p(Dict::Format('Survey-form-alreadydone', $oTarget->Get('date_response')));
		}
		elseif($oSurvey->Get('status') != 'running')
		{
			$oP->p(Dict::S('Survey-form-closed'));
		}
		else
		{
			$oQuizz->ShowForm($oP, $oSurvey, $oTarget);
		}
	}
	catch (UnknownTokenException $e)
	{
		$oP->p(Dict::S('Survey-form-closed'));
	}
}

function SubmitAnswers($oP, $sToken)
{
	list($oTarget, $oSurvey, $oQuizz, $oQuestionSet) = GetContext($sToken);
	$oP->set_title(Dict::S('Survey-Title'));

	$aAnswers = ReadMandatoryParam('answer', 'raw_data');
	$sComment = trim(ReadMandatoryParam('comment', 'raw_data'));

	// Todo - check if there are already some answers (to update)

	$oMyChange = MetaModel::NewObject("CMDBChange");
	$oMyChange->Set("date", time());
	$sUserString = CMDBChange::GetCurrentUserName();
	$oMyChange->Set("userinfo", $sUserString);
	$iChangeId = $oMyChange->DBInsert();

	// Foreach question, find the answer
	//
	while($oQuestion = $oQuestionSet->Fetch())
	{
		$iQuestion = $oQuestion->GetKey();
		
		if (!isset($aAnswers[$iQuestion]))
		{
// TODO: understand why ???
//			$oP->add("<p>Missing answer for question #$iQuestion</p>\n");
		}
		else
		{
			$oAnswer = new SurveyAnswer();
			$oAnswer->Set('survey_target_id', $oTarget->GetKey());
			$oAnswer->Set('question_id', $iQuestion);
			$oAnswer->Set('value', $aAnswers[$iQuestion]);
			
			list($bRes, $aIssues) = $oAnswer->CheckToWrite();
// TODO: understand why ???
			//if ($bRes)
			if (true)
	      {
				$oAnswer->DBInsertTracked($oMyChange);
			}
		}
	}

	// Update the target record
	//
	$oTarget->Set('date_response', time());
	$oTarget->Set('comment', $sComment);
	$oTarget->DBUpdateTracked($oMyChange);

	$oP->add("<p>".Dict::S('Survey-form-done')."</p>\n");
	$oP->add("<p>".Dict::S('Survey-form-thankyou')."</p>\n");
}

/////////////////////////////
//
// Main
//


try
{
	require_once(APPROOT.'/application/startup.inc.php');
	require_once(MODULESROOT.'/customer-survey/quizzwebpage.class.inc.php');
	$oAppContext = new ApplicationContext();
	$sOperation = utils::ReadParam('operation', '');
	
	require_once(APPROOT.'/application/loginwebpage.class.inc.php');

	$sCSSFileSuffix = '/customer-survey/run_survey.css';
	if (@file_exists(MODULESROOT.$sCSSFileSuffix))
	{
//		$oP = new QuizzWebPage(Dict::S('Survey-Title'), $sCSSFileSuffix);
//		$oP->add($sCSSFileSuffix);
	}
	else
	{
//	$oP = new QuizzWebPage(Dict::S('Survey-Title'));
	}
	$oP = new QuizzWebPage('survey'); // title set later...

	$sUrl = utils::GetAbsoluteUrlAppRoot();
	$oP->set_base($sUrl.'pages/');

	$oP->add("<style>
.QuizzQuestion {
	border: #f1f1f6 3px solid;
	padding: 10px;
}


.QuizzMandatory {
	border: #f1f1f6 3px solid;
	color: red;
	padding: 10px;
}

.QuizzQuestion h3 {
	font-size: larger;
	font-weight: bolder;
}

.mandatory_asterisk{
	color: #FF0000;
}

textarea {
	width: 100%;
}
</style>\n");

	switch ($sOperation)
	{
	case 'submit_answers':
		$sToken = ReadMandatoryParam('token', 'raw_data');
		SubmitAnswers($oP, $sToken);
		break;
		
	case 'test':
		$iQuizz = ReadMandatoryParam('quizz_id');
		ShowDraftQuizz($oP, $iQuizz);
		break;

	default:
		$sToken = ReadMandatoryParam('token', 'raw_data');
		ShowQuizz($oP, $sToken);
	}

	$oP->output();
}
catch(CoreException $e)
{
	require_once(APPROOT.'/setup/setuppage.class.inc.php');
	$oP = new SetupWebPage(Dict::S('UI:PageTitle:FatalError'));
	$oP->add("<h1>".Dict::S('UI:FatalErrorMessage')."</h1>\n");	
	$oP->error(Dict::Format('UI:Error_Details', $e->getHtmlDesc()));	
	$oP->output();

	if (MetaModel::IsLogEnabledIssue())
	{
		if (MetaModel::IsValidClass('EventIssue'))
		{
			try
			{
				$oLog = new EventIssue();
	
				$oLog->Set('message', $e->getMessage());
				$oLog->Set('userinfo', '');
				$oLog->Set('issue', $e->GetIssue());
				$oLog->Set('impact', 'Page could not be displayed');
				$oLog->Set('callstack', $e->getTrace());
				$oLog->Set('data', $e->getContextData());
				$oLog->DBInsertNoReload();
			}
			catch(Exception $e)
			{
				IssueLog::Error("Failed to log issue into the DB");
			}
		}

		IssueLog::Error($e->getMessage());
	}

	// For debugging only
	//throw $e;
}
catch(Exception $e)
{
	require_once(APPROOT.'/setup/setuppage.class.inc.php');
	$oP = new SetupWebPage(Dict::S('UI:PageTitle:FatalError'));
	$oP->add("<h1>".Dict::S('UI:FatalErrorMessage')."</h1>\n");	
	$oP->error(Dict::Format('UI:Error_Details', $e->getMessage()));	
	$oP->output();

	if (MetaModel::IsLogEnabledIssue())
	{
		if (MetaModel::IsValidClass('EventIssue'))
		{
			try
			{
				$oLog = new EventIssue();
	
				$oLog->Set('message', $e->getMessage());
				$oLog->Set('userinfo', '');
				$oLog->Set('issue', 'PHP Exception');
				$oLog->Set('impact', 'Page could not be displayed');
				$oLog->Set('callstack', $e->getTrace());
				$oLog->Set('data', array());
				$oLog->DBInsertNoReload();
			}
			catch(Exception $e)
			{
				IssueLog::Error("Failed to log issue into the DB");
			}
		}

		IssueLog::Error($e->getMessage());
	}
}
?>
