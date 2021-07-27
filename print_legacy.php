<?php
// Copyright (C) 2014 Combodo SARL
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

if (!defined('__DIR__')) define('__DIR__', dirname(__FILE__));
require_once(__DIR__.'/../../approot.inc.php');
require_once(APPROOT.'/application/application.inc.php');
require_once(APPROOT.'/application/webpage.class.inc.php');

try
{
	require_once(APPROOT.'/application/startup.inc.php');
	
	require_once(APPROOT.'/application/loginwebpage.class.inc.php');
	LoginWebPage::DoLogin(false /* bMustBeAdmin */, false /* IsAllowedToPortalUsers */); // Check user rights and prompt if needed
	
	$sOperation = utils::ReadParam('operation', '');
	$iSurveyId = (int)utils::ReadParam('survey_id', 0);

	$oSurvey = MetaModel::GetObject('Survey', $iSurveyId);

	$oPage = new NiceWebPage($oSurvey->Get('friendlyname'));
	$oPage->no_cache();
	
	switch($sOperation)
	{
		case 'print_results':
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
