<?php
//
// This page is only meant to provide a short URL to access the normal "export" page
// for the results of a survey, since Excel does not accept long URLs in web queries
//
// Page parameters, as short as possible...
// s : mandatory, the survey ID (e.g. 12)
// o : optional, the organizations to limit the output (e.g. o[]=12&o[]=14). Default: no filtering on orgs
// c : optional, the contacts to limit the ouput (e.g. c[]=124&c[]258). Default: no filtering on contacts
// f : optional, the format of the output: excel | csv. Default: excel.
//

require_once('../../approot.inc.php');
require_once(APPROOT.'application/startup.inc.php');
require_once(APPROOT.'application/utils.inc.php');

$iSurveyId = utils::ReadParam('s', 0);
$aOrgIds = utils::ReadParam('o', array());
$aContactIds = utils::ReadParam('c', array());
$sFormat = utils::ReadParam('f', 'excel');

$sFields = 'question_title,question_description,value';
$sOrgIdClause = '';
if (count($aOrgIds) > 0)
{
	$sOrgIdClause = " AND T.org_id IN(".implode(',', $aOrgIds).")";
}
$sContactIdClause = '';
if (count($aContactIds) > 0)
{
	$sContactIdClause = " AND T.contact_id IN(".implode(',', $aContactIds).")";
}
$oSurvey = MetaModel::GetObject('Survey', $iSurveyId);
if (!$oSurvey->IsAnonymous())
{
	$sFields .= ',contact_name,org_name';
}
		
$sOql = "SELECT SurveyAnswer AS A JOIN SurveyTargetAnswer AS T ON A.survey_target_id = T.id WHERE T.status = 'finished' AND T.survey_id = ".$iSurveyId.$sOrgIdClause.$sContactIdClause;

$sQuery = urlencode($sOql);
$sAbsoluteUrl = utils::GetAbsoluteUrlAppRoot();

switch($sFormat)
{
	case 'excel':
	$sRunQueryUrl = $sAbsoluteUrl.'webservices/export.php?login_mode=basic&format=spreadsheet&expression='.$sQuery.'&fields='.$sFields;
	break;
	
	case 'csv':
	$sRunQueryUrl = $sAbsoluteUrl.'webservices/export.php?format=csv&expression='.$sQuery.'&fields='.$sFields;
	break;
}


// Redirect to the long URL, this is Ok for Excel apparently...
header('Location: '.$sRunQueryUrl);
