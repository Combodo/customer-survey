<?php

/**
 * @copyright   Copyright (C) 2010-2019 Combodo SARL
 * @license     https://www.combodo.com/documentation/combodo-software-license.html
 */

namespace Combodo\iTop\CustomerSurvey\Test;

use Combodo\iTop\Test\UnitTest\ItopDataTestCase;
use Dict;
use MetaModel;
use Survey;
use UserRights;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 * @backupGlobals disabled
 */
class SurveyTest extends ItopDataTestCase
{
	public function testAppendLinkToContent()
	{
		$sNoPlaceholderContent = 'No placeholder';
		$sUrl = 'URL';
		$sQuizLink = '<br/><a href="'.$sUrl.'">'.Dict::S('Survey-notif-linktoquizz').'</a>';
		$sWithPlaceholderContent = 'My superb quizz URL : $quiz_url$. Fantastic !';

		$this->assertSame(
			$sNoPlaceholderContent.$sQuizLink,
			Survey::AppendLinkToContent($sNoPlaceholderContent, $sUrl),
			'No Placeholder'
		);
		$this->assertSame(
			$sWithPlaceholderContent,
			Survey::AppendLinkToContent($sWithPlaceholderContent, $sUrl),
			'With Placeholder'
		);
	}

	public function testApplyParamsToContent()
	{
		$oSurvey = new Survey();
		$sApplyParamsMethodName = 'ApplyParamsToContent';

		$oContact = $this->CreatePerson(0, 1);

		$sNoPlaceholderContent = 'No placeholder';
		$sUrl = 'URL';
		$sQuizLink = '<br/><a href="'.$sUrl.'">'.Dict::S('Survey-notif-linktoquizz').'</a>';
		$sWithPlaceholderContent = 'My superb quizz URL : $quiz_url$. Fantastic !';
		$sWithPlaceholderContentReplaced = 'My superb quizz URL : '.$sUrl.'. Fantastic !';

		$this->assertSame(
			$sNoPlaceholderContent,
			$this->InvokeNonPublicMethod(
				Survey::class,
				$sApplyParamsMethodName,
				$oSurvey,
				[$sNoPlaceholderContent, $oContact, $sUrl, false]
			),
			'AppendLink false, No Placeholder'
		);
		$this->assertSame(
			$sWithPlaceholderContentReplaced,
			$this->InvokeNonPublicMethod(
				Survey::class,
				$sApplyParamsMethodName,
				$oSurvey,
				[$sWithPlaceholderContent, $oContact, $sUrl, false]
			),
			'AppendLink false, With Placeholder'
		);
		$this->assertSame(
			$sNoPlaceholderContent.$sQuizLink,
			$this->InvokeNonPublicMethod(
				Survey::class,
				$sApplyParamsMethodName,
				$oSurvey,
				[$sNoPlaceholderContent, $oContact, $sUrl, true]
			),
			'AppendLink true, No Placeholder'
		);
		$this->assertSame(
			$sWithPlaceholderContentReplaced,
			$this->InvokeNonPublicMethod(
				Survey::class,
				$sApplyParamsMethodName,
				$oSurvey,
				[$sWithPlaceholderContent, $oContact, $sUrl, true]
			),
			'AppendLink true, With Placeholder'
		);
	}

	public function testSendPreview()
	{
		// Set our email transport to file, so we can read it after
		MetaModel::GetConfig()->Set('email_transport', 'LogFile');
		MetaModel::GetConfig()->Set('email_asynchronous', false);

		$sUID = uniqid();
		$sLogin = "login-survey-".$sUID;
		$oUser = $this->CreateUser($sLogin, self::$aURP_Profiles['Administrator'], 'ABCD1234@gabuzomeu');
		$oOnBehalfContact = $this->CreatePerson($sUID, $this->CreateOrganization($sUID)->GetKey());

		$oQuizz = $this->createObject(
			"Quizz",
			[
				'title' => "quizz-$sUID",
				'name' => "quizz-$sUID",
			]
		);
		$oSurvey = $this->createObject(
			"Survey",
			[
				'email_subject' => 'TEST',
				'on_behalf_of' => $oOnBehalfContact->GetKey(),
				'email_body' => '<p>TEST</p>',
				'quizz_id' => $oQuizz->GetKey(),
			]
		);

		$_SESSION = [];
		UserRights::Login($sLogin);

		$this->assertTrue(
			$this->InvokeNonPublicMethod(Survey::class, "SendPreview", $oSurvey, []),
			'stimulus should be ok'
		);
	}

	/**
	 * @dataProvider ApplyParamsSanitizationProvider
	 */
	public function testApplyParamsSanitization($sContent, $sUrl, $bAppendLink, $bSanitizeHtml, $sExpected)
	{
		if ($bSanitizeHtml && !defined('MetaModel::APPLY_PARAMS_SANITIZE_HTML')) {
			$this->markTestSkipped('This iTop version has no HTML sanitization mode in ApplyParams.');
		}
		$sMode = $bSanitizeHtml
			? MetaModel::APPLY_PARAMS_SANITIZE_HTML
			: (defined('MetaModel::APPLY_PARAMS_SANITIZE_NONE') ? MetaModel::APPLY_PARAMS_SANITIZE_NONE : null);
		$oSurvey = new Survey();
		$oContact = $this->CreatePerson(0, 1);

		$this->assertSame(
			$sExpected,
			$this->InvokeNonPublicMethod(
				Survey::class,
				'ApplyParamsToContent',
				$oSurvey,
				[$sContent, $oContact, $sUrl, $bAppendLink, $sMode]
			)
		);
	}

	public function ApplyParamsSanitizationProvider()
	{
		return [
			'plain subject keeps markup and ampersands' => [
				'Survey <created> & $quiz_url$', 'https://example.com/?a=1&b=2', false, false,
				'Survey <created> & https://example.com/?a=1&b=2',
			],
			'HTML is sanitized after substitution' => [
				'<a href="$quiz_url$">Survey</a>', 'javascript:alert(1)/*https://example.com*/', true, true,
				'<a>Survey</a>',
			],
			'HTML keeps valid placeholder links' => [
				'<a href="%24quiz_url%24">Survey</a>', 'https://example.com/survey', true, true,
				'<a href="https://example.com/survey">Survey</a>',
			],
		];
	}
}
