<?php
// Copyright (C) 2013 Combodo SARL
//
//   This file is part of iTop.
//
//   iTop is free software; you can redistribute it and/or modify	
//   it under the terms of the GNU Affero General Public License as published by
//   the Free Software Foundation, either version 3 of the License, or
//   (at your option) any later version.
//
//   iTop is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU Affero General Public License for more details.
//
//   You should have received a copy of the GNU Affero General Public License
//   along with iTop. If not, see <http://www.gnu.org/licenses/>
/**
 * Time Tracking AJAX calls processing
 *
 * @copyright   Copyright (C) 2013 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

require_once('../../approot.inc.php');
require_once(APPROOT.'/application/application.inc.php');
require_once(APPROOT.'/application/webpage.class.inc.php');
require_once(APPROOT.'/application/ajaxwebpage.class.inc.php');

try
{
	require_once(APPROOT.'/application/startup.inc.php');
	
	require_once(APPROOT.'/application/loginwebpage.class.inc.php');
	LoginWebPage::DoLogin(false /* bMustBeAdmin */, false /* IsAllowedToPortalUsers */); // Check user rights and prompt if needed
	
	$oPage = new ajax_page("");
	$oPage->no_cache();

	$sOperation = utils::ReadParam('operation', '');
	$iSurveyId = (int)utils::ReadParam('survey_id', 0);
	
	
	switch($sOperation)
	{
		case 'send_again':
		$oSurvey = MetaModel::GetObject('Survey', $iSurveyId);
		$aTargets = utils::ReadParam('targets', array());
		$sSubject = utils::ReadParam('email_subject','', false, 'raw_data');
		$sBody = utils::ReadParam('email_body', '', false, 'raw_data');
		if (!is_array($aTargets))
		{
			$aTargets = array();
		}
		if (count($aTargets) > 0)
		{
			$sOQL = 'SELECT SurveyTargetAnswer AS T WHERE T.id IN('.implode(',', $aTargets).') AND T.survey_id = '.$oSurvey->GetKey();
			$oSet = new DBObjectSet(DBObjectSearch::FromOQL($sOQL));
			while($oSTA = $oSet->Fetch())
			{
				$oSurvey->SendAgainQuizzToTargetContact($oSTA, $sSubject, $sBody);
			}
		}
		// update the list of notifications sent
		//$oSurvey->DisplayNotifications($oPage);
		$oPage->add_ready_script('window.location.reload();'); // brute force reload of the whole page...
		break;
		
		case 'filter_stats':
		$oSurvey = MetaModel::GetObject('Survey', $iSurveyId);
			
		$aOrgIds = utils::ReadParam('org_id', array());
		if (!is_array($aOrgIds))
		{
			$aOrgIds = array();
		}
		$aContactIds = utils::ReadParam('contact_id', array());
		if (!is_array($aContactIds))
		{
			$aContactIds = array();
		}
		$oSurvey->DisplayStatisticsAndExport($oPage, false /* bPrintable */, $aOrgIds, $aContactIds);
		break;
		
		case 'refresh_contacts_filter':
		$oSurvey = MetaModel::GetObject('Survey', $iSurveyId);
			
		$aOrgIds = utils::ReadParam('org_id', array());
		if (!is_array($aOrgIds))
		{
			$aOrgIds = array();
		}
		$oPage->add($oSurvey->GetContactsFilter($aOrgIds));
		$oPage->add_ready_script("$('#filter_stats_contact_id').multiselect({header: false, noneSelectedText: '".addslashes(Dict::S('UI:SearchValue:Any'))."', selectedList: 1, selectedText:'".addslashes(Dict::S('UI:SearchValue:NbSelected'))."'});");
		break;
		
		case 'print_results':
		$oSurvey = MetaModel::GetObject('Survey', $iSurveyId);
		$oPage = new NiceWebPage($oSurvey->GetName());
		$oSurvey = MetaModel::GetObject('Survey', $iSurveyId);
		$aOrgIds = utils::ReadParam('org_id', array());
		if (!is_array($aOrgIds))
		{
			$aOrgIds = array();
		}
		$aContactIds = utils::ReadParam('contact_id', array());
		if (!is_array($aContactIds))
		{
			$aContactIds = array();
		}
		$oSurvey->DisplayResultsTab($oPage, true, $aOrgIds, $aContactIds); // true => printable
		break;
	}
	
	$oPage->output();
}
catch(Exception $e)
{
	// note: transform to cope with XSS attacks
	echo htmlentities($e->GetMessage(), ENT_QUOTES, 'utf-8');
	IssueLog::Error($e->getMessage());	
}
