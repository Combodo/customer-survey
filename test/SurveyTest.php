<?php
/**
 * @copyright   Copyright (C) 2010-2019 Combodo SARL
 * @license     https://www.combodo.com/documentation/combodo-software-license.html
 */


namespace Combodo\iTop\CustomerSurvey\Test;


use Combodo\iTop\Test\UnitTest\ItopDataTestCase;
use \Dict;
use Survey;

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
			$sNoPlaceholderContent,
			Survey::AppendLinkToContent(false, $sNoPlaceholderContent, $sUrl),
			'AppendLink false, No Placeholder'
		);
		$this->assertSame(
			$sNoPlaceholderContent.$sQuizLink,
			Survey::AppendLinkToContent(true, $sNoPlaceholderContent, $sUrl),
			'AppendLink true, No Placeholder'
		);
		$this->assertSame(
			$sWithPlaceholderContent,
			Survey::AppendLinkToContent(false, $sWithPlaceholderContent, $sUrl),
			'AppendLink false, With Placeholder'
		);
		$this->assertSame(
			$sWithPlaceholderContent,
			Survey::AppendLinkToContent(true, $sWithPlaceholderContent, $sUrl),
			'AppendLink true, With Placeholder'
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
			$this->InvokeNonPublicMethod(Survey::class, $sApplyParamsMethodName, $oSurvey, [$sNoPlaceholderContent, $oContact, $sUrl, false]),
			'AppendLink false, No Placeholder'
		);
		$this->assertSame(
			$sNoPlaceholderContent.$sQuizLink,
			$this->InvokeNonPublicMethod(Survey::class, $sApplyParamsMethodName, $oSurvey, [$sNoPlaceholderContent, $oContact, $sUrl, true]),
			'AppendLink true, No Placeholder'
		);
		$this->assertSame(
			$sWithPlaceholderContentReplaced,
			$this->InvokeNonPublicMethod(Survey::class, $sApplyParamsMethodName, $oSurvey, [$sWithPlaceholderContent, $oContact, $sUrl, true]),
			'AppendLink true, With Placeholder'
		);
	}
}
