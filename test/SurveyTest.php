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

	/**
	 * @dataProvider ApplyParamsToContentProvider
	 */
	public function testApplyParamsToContent($sInitialContent, $aParams, $sExpectedContent, $bShouldLinkBeAppended)
	{
		$oSurvey = new Survey();

		$sActualContent = $this->InvokeNonPublicMethod(Survey::class, 'ApplyParamsToContent', $oSurvey, [$sInitialContent, $aParams, 'URL']);

		$this->assertSame($sExpectedContent, $sActualContent);
	}

	public function ApplyParamsToContentProvider() {
		return [
			'No placeholder' => ['No placeholder', [], 'No placeholder', true],
		];
	}
}
