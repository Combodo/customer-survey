<?php
/**
 * @copyright   Copyright (C) 2010-2019 Combodo SARL
 * @license     https://www.combodo.com/documentation/combodo-software-license.html
 */


use Combodo\iTop\Test\UnitTest\ItopDataTestCase;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 * @backupGlobals disabled
 */
class SurveyTest extends ItopDataTestCase
{
	public function testAppendLinkToContent() {
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
			$this->InvokeNonPublicMethod(Survey::class, $sApplyParamsMethodName, $oSurvey,
				[$sNoPlaceholderContent, $oContact, $sUrl, false]),
			'AppendLink false, No Placeholder'
		);
		$this->assertSame(
			$sWithPlaceholderContentReplaced,
			$this->InvokeNonPublicMethod(Survey::class, $sApplyParamsMethodName, $oSurvey,
				[$sWithPlaceholderContent, $oContact, $sUrl, false]),
			'AppendLink false, With Placeholder'
		);
		$this->assertSame(
			$sNoPlaceholderContent.$sQuizLink,
			$this->InvokeNonPublicMethod(Survey::class, $sApplyParamsMethodName, $oSurvey,
				[$sNoPlaceholderContent, $oContact, $sUrl, true]),
			'AppendLink true, No Placeholder'
		);
		$this->assertSame(
			$sWithPlaceholderContentReplaced,
			$this->InvokeNonPublicMethod(Survey::class, $sApplyParamsMethodName, $oSurvey,
				[$sWithPlaceholderContent, $oContact, $sUrl, true]),
			'AppendLink true, With Placeholder'
		);
	}

	public function testSendPreview()
	{
		$sUID = uniqid();
		$sLogin = "login-survey-".$sUID;
		$oUser = $this->CreateUser($sLogin, self::$aURP_Profiles['Administrator'], 'ABCD1234@gabuzomeu');
		$oOnBehalfContact = $this->CreatePerson($sUID, $this->CreateOrganization($sUID)->GetKey());

		$oQuizz = $this->createObject("Quizz",
			[
				'title' => "quizz-$sUID",
				'name' => "quizz-$sUID",
			]);
		$oSurvey = $this->createObject("Survey",
			[
				'email_subject' => 'TEST',
				'on_behalf_of' => $oOnBehalfContact->GetKey(),
				'email_body' => '<p>TEST</p>',
				'quizz_id' => $oQuizz->GetKey(),
			]);


		$_SESSION = array();
		UserRights::Login($sLogin);

		$this->assertTrue($this->InvokeNonPublicMethod(Survey::class, "SendPreview", $oSurvey, []),
			'stimulus should be ok'
		);
	}
}
