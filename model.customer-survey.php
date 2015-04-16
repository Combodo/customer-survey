<?php
// Copyright (C) 2011-2014 Combodo SARL
//

/**
 * Module customer-survey
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */

/**
 *
 * Defines a quizz used to generate a survey
 *
 */
class Quizz extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,quizz",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "qz_quizz",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();


		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeApplicationLanguage("language", array("allowed_values"=>null, "sql"=>"language", "default_value"=>"EN US", "is_null_allowed"=>false, "depends_on"=>array())));
		
		MetaModel::Init_AddAttribute(new AttributeString("title", array("allowed_values"=>null, "sql"=>"title", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeHTML("introduction", array("allowed_values"=>null, "sql"=>"introduction", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeInteger("min_value", array("allowed_values"=>null, "sql"=>"min_value", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeString("min_label", array("allowed_values"=>null, "sql"=>"min_label", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeInteger("max_value", array("allowed_values"=>null, "sql"=>"max_value", "default_value"=>10, "is_null_allowed"=>false, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeString("max_label", array("allowed_values"=>null, "sql"=>"max_label", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeString("above_labels", array("allowed_values"=>null, "sql"=>"above_labels", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeEnum("comments", array("allowed_values"=>new ValueSetEnum('yes,no'), "sql"=>"comments", "default_value"=>"yes", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("scale_values", array("allowed_values"=>null, "sql"=>"scale_values", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeHTML("conclusion", array("allowed_values"=>null, "sql"=>"conclusion", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSet("survey_list", array("linked_class"=>"Survey", "ext_key_to_me"=>"quizz_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSet("question_list", array("linked_class"=>"QuizzElement", "ext_key_to_me"=>"quizz_id", "edit_mode" => LINKSET_EDITMODE_INPLACE, "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

//		MetaModel::Init_AddAttribute(new AttributeText("default_message", array("allowed_values"=>null, "sql"=>"default_message", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array(
				'survey_list',
				'question_list',
				'col:0'=> array(
				'fieldset:Survey-quizz-frame-definition' => array('name','description', 'language', 'scale_values'),
				'fieldset:Survey-quizz-frame-description' => array('title','introduction'),
				'fieldset:Survey-quizz-last-page' => array('conclusion'),
				),
		));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'description', 'language', 'title', 'introduction'));
		MetaModel::Init_SetZListItems('list', array('description', 'language'));
	}

	public function __construct($aRow = null, $sClassAlias = '', $aAttToLoad = null, $aExtendedDataSpec = null)
	{
		parent::__construct($aRow, $sClassAlias, $aAttToLoad, $aExtendedDataSpec);
		if ($aRow == null)
		{
			// creating a brand new object, initialize the "scale values" from the configuration
			$sModule = basename(dirname(__FILE__));
			$sScaleValues = MetaModel::GetModuleSetting($sModule, 'quiz_scale', '');
			$this->Set('scale_values', $sScaleValues);
		}
	}

	/**
	 * Add a tab to display a preview of the quizz
	 * @param object $oPage Page
	 * @param bool $bEditMode True if in edition, false in Read-only mode
	 * @return void
	 */
	function DisplayBareRelations(WebPage $oPage, $bEditMode = false)
	{
		parent::DisplayBareRelations($oPage, $bEditMode);
		if (!$bEditMode)
		{
			$oPage->SetCurrentTab(Dict::S('Survey-quizz-overview'));
			$oPage->p(Dict::S('Survey-quizz-shortcuttoquizz').': <a href="'.$this->MakeFormUrl().'" target="_blank">'.Dict::S('Survey-quizz-shortcutlabel').'</a>');
		}
	}

	/**
	 * Helper to get a URL pointing to the quizz form
	 * @param string sToken Identifies the target answer ; if not present, the form is shown in test mode	 
	 * @return string HTTP URL fo the form
	 */
	function MakeFormUrl($sToken = null)
	{
		$sAbsoluteUrl = utils::GetAbsoluteUrlModulesRoot();
		if ($sToken)
		{
			$sUrl = $sAbsoluteUrl.'customer-survey/run_survey.php?token='.urlencode($sToken);
		}
		else
		{
			// Draft: no token supplied
			$sUrl = $sAbsoluteUrl.'customer-survey/run_survey.php?quizz_id='.$this->GetKey();
		}
		return $sUrl;
	}

	/**
	 * Change the current language to the language of the quizz
	 * @return void
	 */
	public function ChangeDictionnaryLanguage()
	{
		$this->m_sApplicationLanguage = Dict::GetUserLanguage();
		Dict::SetUserLanguage($this->Get('language'));
	}

	/**
	 * Restore the current language the value it had when calling ChangeDictionnaryLanguage
	 * @return void
	 */
	public function RestoreDictionnaryLanguage()
	{
		Dict::SetUserLanguage($this->m_sApplicationLanguage);
	}
}

/**
 *
 * A simple question inside a quizz
 *
 */
abstract class QuizzElement extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,quizz",
			"key_type" => "autoincrement",
			"name_attcode" => array("order", "title"),
			"state_attcode" => "",
			"reconc_keys" => array("quizz_id_friendlyname", "order"),
			"db_table" => "qz_element",
			"db_key_field" => "id",
			"db_finalclass_field" => "finalclass",
			"icon" => "",
			"order_by_default" => array('order' => true, 'title' => true),
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("quizz_id", array("targetclass"=>"Quizz", "jointype"=>null, "allowed_values"=>null, "sql"=>"quizz_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("order", array("allowed_values"=>null, "sql"=>"order", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("title", array("allowed_values"=>null, "sql"=>"title", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("mandatory", array("allowed_values"=>new ValueSetEnum('yes,no'), "sql"=>"mandatory", "default_value"=>"yes", "is_null_allowed"=>false, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('quizz_id', 'order', 'finalclass', 'title', 'description', 'mandatory'));
		MetaModel::Init_SetZListItems('standard_search', array('quizz_id', 'title', 'description', 'mandatory'));
		MetaModel::Init_SetZListItems('list', array('order', 'title', 'description', 'mandatory'));
	}
	
	public function HasValue()
	{
		return true;
	}
	
	public function IsNewPage()
	{
		return false;
	}
	
	/**
	 * Check that the value is an valid one for this question
	 * @param string $sValue The value to check
	 * @return string The value to store
	 */
	public function ValidateValue($sValue)
	{
		// By default, any value will do
		return $sValue;
	}
	
	abstract public function DisplayForm(WebPage $oPage, $sCurrentValue);
	abstract public function DisplayResults(WebPage $oPage, DBObjectSet $oAnswerSet, $iTargetCount, $bAnonymous = false);
	
	/**
	 * Helper method for derived classes to display an horizontal set of radio buttons
	 * based on the given list of "choices"
	 * @param WebPage $oPage
	 * @param array $aChoices
	 * @param string $sCurrentValue
	 */
	protected function DisplayChoices(WebPage $oPage, $aChoices, $sCurrentValue)
	{
		$iQuestionId = $this->GetKey();
		$sTitle = $this->GetAsHtml('title');
		$sDescription = $this->GetAsHtml('description');
		if ($this->Get('mandatory') == 'yes')
		{
			$oPage->add("<h3 class=\"question_title mandatory\">$sTitle <span class=\"mandatory_asterisk\" title=\"".Dict::S('Survey-MandatoryQuestion')."\">*</span></h3>");
		}
		else
		{
			$oPage->add("<h3 class=\"question_title mandatory\">$sTitle</h3>");
		}
		$oPage->add("<div class=\"question_description\">$sDescription</div>");

		$sTDProps = "width=\"80px\" align=\"center\"";

		$oPage->add("<table class=\"radio_buttons\">");

		$oPage->add("<tr>");
		foreach($aChoices as $sValue)
		{
			$sValue = trim($sValue);
			$oPage->add("<td $sTDProps>$sValue</td>");
		}
		$oPage->add("</tr>");
		$oPage->add("<tr>");
		foreach($aChoices as $sValue)
		{
			$sValue = trim($sValue);
			$sChecked = ($sCurrentValue == $sValue) ? 'checked' : '';
			$sMandatory = ($this->Get('mandatory') == 'yes') ? 'true' : 'false';
			$oPage->add("<td $sTDProps><INPUT type=\"radio\" $sChecked name=\"answer[$iQuestionId]\" value=\"$sValue\" data-mandatory=\"$sMandatory\"></td>");
		}
		$oPage->add("</tr>");
		$oPage->add("</table>");		
	}
	
	protected function DrawHtmlBar($oPage, $sLabel, $iPercentage)
	{
		$iWidth = 200 * $iPercentage / 100; // 200 px = 100 %
		$oPage->add('<tr>');
		$sBar = '';
		if ($iWidth > 1)
		{
			// Draw a bar with a border around the colored area so that it gets printed (browers usually don't print the background colors)
			$sBar = '<div style="width:'.$iWidth.'px; display: inline-block; background: #1C94C4; border: 1px #1C94C4 solid;">&nbsp;</div>';
		}
		$oPage->add('<td style="padding: 2px; width:150px; text-align:right;">'.$sLabel.'</td><td style="border-left: 1px #1C94C4 solid; padding:2px; padding-left:0;">'.$sBar.'&nbsp;'.$iPercentage.' %</td>');
		$oPage->add('</tr>');
		
	}
}

class QuizzScaleQuestion extends QuizzElement
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,quizz",
			"key_type" => "autoincrement",
			"name_attcode" => array("order", "title"),
			"state_attcode" => "",
			"reconc_keys" => array("quizz_id_friendlyname", "order"),
			"db_table" => "qz_scale_question",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalField("scale_values", array("extkey_attcode"=> 'quizz_id', "target_attcode"=>"scale_values")));
	}
	
	public function DisplayForm(WebPage $oPage, $sCurrentValue)
	{
		$aChoices = explode(',', $this->Get('scale_values'));
		$this->DisplayChoices($oPage, $aChoices, $sCurrentValue);	
	}
	
	public function DisplayResults(WebPage $oPage, DBObjectSet $oAnswerSet, $iTargetCount, $bAnonymous = false)
	{
		$oPage->add('<h2>'.$this->GetAsHtml('title').'</h2>');
		$oPage->p($this->GetAsHtml('description'));
		
		$aChoices = explode(',', $this->Get('scale_values'));
		$aResults = array();
		foreach($aChoices as $sValue)
		{
			$aResults[trim($sValue)] = 0;
		}
		while ($oAnswer = $oAnswerSet->Fetch())
		{
			$sAnswer = $oAnswer->Get('value');
			// Note: the answer might be undefined if the question is optional
			if (array_key_exists($sAnswer, $aResults))
			{
				$aResults[$sAnswer] += 1;
			}
		}

		$oPage->add('<table style="border-collapse: collapse;">');
		foreach($aChoices as $sValue)
		{
			$iPercentage = round(100 * $aResults[trim($sValue)] / $iTargetCount);
			$this->DrawHtmlBar($oPage, $sValue, $iPercentage);
		}
		$oPage->add('</table>');	
	}
	
	/**
	 * Check that the value is an valid one for this question
	 * @param string $sValue The value to check
	 * @return string The value to store
	 */
	public function ValidateValue($sValue)
	{
		$aChoices = explode(',', $this->Get('scale_values'));
		// Check that the value is one of the possible values
		foreach($aChoices as $sPossibleValue)
		{
			if (trim($sPossibleValue) == trim($sValue))
			{
				return trim($sValue);
			}
		}
		// By default, store an empty string...
		return '';
	}
}

class QuizzFreeTextQuestion extends QuizzElement
{
	static protected $bScriptOutput = false;
	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,quizz",
			"key_type" => "autoincrement",
			"name_attcode" => array("order", "title"),
			"state_attcode" => "",
			"reconc_keys" => array("quizz_id_friendlyname", "order"),
			"db_table" => "qz_free_text",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
	}
	
	public function DisplayForm(WebPage $oPage, $sCurrentValue)
	{
		$sTitle = $this->GetAsHtml('title');
		$sDescription = $this->GetAsHtml('description');
		$iQuestionId = $this->GetKey();
		if ($this->Get('mandatory') == 'yes')
		{
			$oPage->add("<h3 class=\"question_title mandatory\">$sTitle <span class=\"mandatory_asterisk\" title=\"".Dict::S('Survey-MandatoryQuestion')."\">*</span></h3>");
		}
		else
		{
			$oPage->add("<h3 class=\"question_title\">$sTitle</h3>");
		}
		$sMandatory = ($this->Get('mandatory') == 'yes') ? 'true' : 'false';
		$oPage->add("<div class=\"question_description\">$sDescription</div>");
		$oPage->add('<TEXTAREA style="width:99%;" name="answer['.$iQuestionId.']" data-mandatory="'.$sMandatory.'">'.htmlentities($sCurrentValue, ENT_QUOTES, 'UTF-8').'</TEXTAREA>');
	}
	
	public function DisplayResults(WebPage $oPage, DBObjectSet $oAnswerSet, $iTargetCount, $bAnonymous = false)
	{
		$oPage->add('<h2>'.$this->GetAsHtml('title').'</h2>');
		$oPage->p($this->GetAsHtml('description'));
		
		$aValues = array();
		$sAuthor = '';
		while($oAnswer = $oAnswerSet->Fetch())
		{
			$sValue = $oAnswer->Get('value');
			if (trim($sValue) != '')
			{
				$sAuthor = $oAnswer->Get('contact_name');
				$aValues[] = array('text' => $sValue, 'author' => $oAnswer->Get('contact_name'));
			}
		}
		$oPage->add('<div class="Collapsible"><span class="CollapsibleLabel">'.Dict::Format('Survey-results-X_NonEmptyValuesOutOf_N', count($aValues), $iTargetCount).'</span><div class="CollapsibleContent">');
		foreach($aValues as $aAnswer)
		{
			$oPage->add('<div class="triangle-border"><div class="user_comment">'.htmlentities($aAnswer['text'], ENT_QUOTES, 'UTF-8').'</div></div>');
			if (!$bAnonymous)
			{
				$oPage->add('<div class="author">'.htmlentities($aAnswer['author'], ENT_QUOTES, 'UTF-8').'</div>');
			}
		}
		$oPage->add('</div>');
		
		if (!self::$bScriptOutput)
		{
			self::$bScriptOutput = true; // output this only once per page
			if (!$bAnonymous)
			{
				$sBubbleSpeechStyle = 
<<<EOF
.triangle-border:after {
    border-color: #FFFFFF transparent;
    border-style: solid;
    border-width: 9px 9px 0;
    bottom: -9px;
    content: "";
    display: block;
    left: 21px;
    position: absolute;
    width: 0;
}
.triangle-border:before {
    border-color: #1C94C4 transparent;
    border-style: solid;
    border-width: 10px 10px 0;
    bottom: -10px;
    content: "";
    display: block;
    left: 20px;
    position: absolute;
    width: 0;
}

.user_comment {
	white-space: pre-wrap;
}

.author {
	font-size: small;
}
EOF
				;
			}
			else
			{
				$sBubbleSpeechStyle = '';
			}
			$oPage->add_style(
<<<EOF
.CollapsibleContent {
	display: none;
}
div.open div.CollapsibleContent {
	display: block;
	background: #eee;
	padding: 0.25em;
	margin: 0.25em;
}
.CollapsibleLabel {
	padding-left: 16px;
	background: url(../images/plus.gif) left no-repeat;
	cursor: pointer;
}
div.open div.CollapsibleLabel {
	background: url(../images/minus.gif) left no-repeat;
}
.triangle-border {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #1C94C4;
    border-radius: 10px 10px 10px 10px;
    color: #333333;
    margin: 1em 0 0.5em;
    padding: 0.5em;
    position: relative;
}
$sBubbleSpeechStyle
EOF
			);
			$oPage->add_ready_script(
<<<EOF
$('.CollapsibleLabel').click(function() { $(this).parent().toggleClass('open'); });
EOF
			);			
		}
	}
}


class QuizzNewPageElement extends QuizzElement
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,quizz",
			"key_type" => "autoincrement",
			"name_attcode" => array("order", "title"),
			"state_attcode" => "",
			"reconc_keys" => array("quizz_id_friendlyname", "order"),
			"db_table" => "qz_new_page",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
	}
	
	public function DisplayForm(WebPage $oPage, $sCurrentValue)
	{
		// Nothing to do here, handled directly by the QuizzWizardController
	}
	public function DisplayResults(WebPage $oPage, DBObjectSet $oAnswerSet, $iTargetCount, $bAnonymous = false)
	{
		$oPage->add('<hr/>');
		$oPage->add('<h2>'.$this->GetAsHtml('title').'</h2>');
		$oPage->p($this->GetAsHtml('description'));
	}
	
	public function HasValue()
	{
		return false;
	}
	
	public function IsNewPage()
	{
		return true;
	}
	/**
	 * Returns the set of flags (OPT_ATT_HIDDEN, OPT_ATT_READONLY, OPT_ATT_MANDATORY...)
	 * for the given attribute in the current state of the object
	 * @param $sAttCode string $sAttCode The code of the attribute
	 * @param $aReasons array To store the reasons why the attribute is read-only (info about the synchro replicas)
	 * @param $sTargetState string The target state in which to evalutate the flags, if empty the current state will be used
	 * @return integer Flags: the binary combination of the flags applicable to this attribute
	 */	 	  	 	
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		$iFlags = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
		
		// The 'mandatory' flag is not editable, page breaks are always mandatory
		if ($sAttCode == 'mandatory')
		{
			$iFlags |= OPT_ATT_READONLY;
		}
		return $iFlags;
	}

	/**
	 * Returns the set of flags (OPT_ATT_HIDDEN, OPT_ATT_READONLY, OPT_ATT_MANDATORY...)
	 * for the given attribute for the current state of the object considered as an INITIAL state
	 * @param string $sAttCode The code of the attribute
	 * @return integer Flags: the binary combination of the flags applicable to this attribute
	 */	 	  	 	
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array())
	{
		$iFlags = parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);

		// The 'mandatory' flag is not editable, page breaks are always mandatory
		if ($sAttCode == 'mandatory')
		{
			$iFlags |= OPT_ATT_READONLY;
		}
		return $iFlags;
	}	
	
}

class QuizzValueQuestion extends QuizzElement
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,quizz",
			"key_type" => "autoincrement",
			"name_attcode" => array("order", "title"),
			"state_attcode" => "",
			"reconc_keys" => array("quizz_id_friendlyname", "order"),
			"db_table" => "qz_value_question",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeText("choices", array("allowed_values"=>null, "sql"=>"choices", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		
		MetaModel::Init_SetZListItems('details', array('quizz_id', 'order', 'title', 'description', 'choices', 'mandatory'));
	}

	public function DisplayForm(WebPage $oPage, $sCurrentValue)
	{
		$aChoices = explode(',', $this->Get('choices'));
		$this->DisplayChoices($oPage, $aChoices, $sCurrentValue);			
	}
	public function DisplayResults(WebPage $oPage, DBObjectSet $oAnswerSet, $iTargetCount, $bAnonymous = false)
	{
		$oPage->add('<h2>'.$this->GetAsHtml('title').'</h2>');
		$oPage->p($this->GetAsHtml('description'));
		
		$aChoices = explode(',', $this->Get('choices'));
		$aResults = array();
		foreach($aChoices as $sValue)
		{
			$aResults[trim($sValue)] = 0;
		}
		while ($oAnswer = $oAnswerSet->Fetch())
		{
			$sAnswer = $oAnswer->Get('value');
			// Note: the answer might be undefined if the question is optional
			if (array_key_exists($sAnswer, $aResults))
			{
				$aResults[$sAnswer] += 1;
			}
		}

		$oPage->add('<table style="border-collapse: collapse;">');
		foreach($aChoices as $sValue)
		{
			$iPercentage = round(100 * $aResults[trim($sValue)] / $iTargetCount);
			$this->DrawHtmlBar($oPage, $sValue, $iPercentage);
		}
		$oPage->add('</table>');		
	}
	
	/**
	 * Check that the value is an valid one for this question
	 * @param string $sValue The value to check
	 * @return string The value to store
	 */
	public function ValidateValue($sValue)
	{
		$aChoices = explode(',', $this->Get('choices'));
		// Check that the value is one of the possible values
		foreach($aChoices as $sPossibleValue)
		{
			if (trim($sPossibleValue) == trim($sValue))
			{
				return trim($sValue);
			}
		}
		// By default, store an empty string...
		return '';
	}
}

/**
 *
 * Survey: an instanciation of a quizz for a given set of persons
 *
 */
class Survey extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,survey",
			"key_type" => "autoincrement",
			"name_attcode" => array("quizz_id_friendlyname", "date_sent"),
			"state_attcode" => "status",
			"reconc_keys" => array("quizz_id_friendlyname", "date_sent"),
			"db_table" => "qz_survey",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("quizz_id", array("targetclass"=>"Quizz", "jointype"=>null, "allowed_values"=>null, "sql"=>"quizz_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("language", array("allowed_values"=>null, "extkey_attcode"=> 'quizz_id', "target_attcode"=>"language")));

		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum('new,running,closed'), "sql"=>"status", "default_value"=>"new", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDateTime("date_sent", array("allowed_values"=>null, "sql"=>"date_sent", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("on_behalf_of", array("targetclass"=>"Contact", "jointype"=>null, "allowed_values"=>null, "sql"=>"on_behalf_of", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("target_phrase_id", array("targetclass"=>"QueryOQL", "jointype"=>null, "allowed_values"=>new ValueSetObjects("SELECT QueryOQL WHERE (oql LIKE 'SELECT Person %') OR (oql LIKE 'SELECT Contact %')"), "sql"=>"target_phrase_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		// Sne dme an email when someone completes the survey
		MetaModel::Init_AddAttribute(new AttributeEnum("email_on_completion", array("allowed_values"=>new ValueSetEnum('yes,no'), "sql"=>"email_on_completion", "default_value"=>"no", "is_null_allowed"=>false, "depends_on"=>array())));
		
		MetaModel::Init_AddAttribute(new AttributeString("email_subject", array("allowed_values"=>null, "sql"=>"email_subject", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeHTML("email_body", array("allowed_values"=>null, "sql"=>"email_body", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("survey_target_list", array("linked_class"=>"SurveyTarget", "ext_key_to_me"=>"survey_id", "ext_key_to_remote"=>"contact_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSet("survey_target_answer_list", array("linked_class"=>"SurveyTargetAnswer", "ext_key_to_me"=>"survey_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array(), "tracking_level"=>'none')));

		MetaModel::Init_SetZListItems('details', array('quizz_id', 'language', 'status', 'date_sent', 'on_behalf_of', 'email_on_completion', 'email_subject', 'email_body', 'target_phrase_id', 'survey_target_list'));
		MetaModel::Init_SetZListItems('standard_search', array('quizz_id', 'status', 'date_sent', 'language'));
		MetaModel::Init_SetZListItems('list', array('status', 'date_sent', 'language'));

		// Lifecycle
		MetaModel::Init_DefineState(
			"new",
			array(
				"attribute_inherit" => null,
				"attribute_list" => array(
					//'status' => OPT_ATT_HIDDEN,
					'quizz_id' => OPT_ATT_NORMAL,
					'date_sent' => OPT_ATT_HIDDEN,
					'on_behalf_of' => OPT_ATT_NORMAL,
					'email_subject' => OPT_ATT_NORMAL,
					'email_body' => OPT_ATT_NORMAL,
					'target_phrase_id' => OPT_ATT_NORMAL,
			),
			)
		);
		MetaModel::Init_DefineState(
			"running",
			array(
				"attribute_inherit" => 'new',
				"attribute_list" => array(
					'quizz_id' => OPT_ATT_READONLY,
					'date_sent' => OPT_ATT_READONLY,
					'on_behalf_of' => OPT_ATT_READONLY,
					'email_subject' => OPT_ATT_READONLY,
					'email_body' => OPT_ATT_READONLY,
					'target_phrase_id' => OPT_ATT_READONLY,
			),
			)
		);
		MetaModel::Init_DefineState(
			"closed",
			array(
				"attribute_inherit" => 'running',
				"attribute_list" => array(
				),
			)
		);

		MetaModel::Init_DefineStimulus(new StimulusUserAction("ev_start", array()));
		MetaModel::Init_DefineStimulus(new StimulusUserAction("ev_close", array()));
		MetaModel::Init_DefineStimulus(new StimulusUserAction("ev_test", array()));

		MetaModel::Init_DefineTransition("new", "ev_test", array("target_state"=>"new", "actions"=>array(array('verb' => 'SendPreview', 'params' => array())), "user_restriction"=>null));
		MetaModel::Init_DefineTransition("new", "ev_start", array("target_state"=>"running", "actions"=>array(array('verb' => 'SendQuizz', 'params' => array())), "user_restriction"=>null));
		MetaModel::Init_DefineTransition("running", "ev_test", array("target_state"=>"running", "actions"=>array(array('verb' => 'SendPreview', 'params' => array())), "user_restriction"=>null));
		MetaModel::Init_DefineTransition("running", "ev_close", array("target_state"=>"closed", "actions"=>array(), "user_restriction"=>null));
	}

	protected $m_sApplicationLanguage;

	// Lifecycle actions
	//
	public function SendQuizz($sStimulusCode)
	{
		$this->Set('date_sent', time());

		$aContacts = array();

		$iQuery = $this->Get('target_phrase_id');
		if ($iQuery != 0)
		{
			$oQuery = MetaModel::GetObject('QueryOQL', $iQuery, true, true /*allow all data*/);
			$sQuery = $oQuery->Get('oql');
			try
			{
				$oSearch = DBObjectSearch::FromOQL($sQuery);
				if (MetaModel::IsParentClass('Contact', $oSearch->GetClass()))
				{
					$oSet = new DBObjectSet($oSearch);
					while($oContact = $oSet->Fetch())
					{
						$this->SendQuizzToTargetContact($oContact);
						$aContacts[$oContact->GetKey()] = true;
					}
				}
				else
				{
					IssueLog::Error('customer-survey - send quizz, phrase not defining a set of Contacts: '.$oQuery->GetName().' #'.$oQuery->GetKey());
				}
			}
			catch (OqlException $e)
			{
				IssueLog::Error('customer-survey - send quizz, OQL error: '.$e->getMessage());
			}
		}

		$oTargetSet = $this->GetTargetsFromDB();
		while($oTarget = $oTargetSet->Fetch())
		{
			if (!array_key_exists($oTarget->GetKey(), $aContacts))
			{
				$oContact = MetaModel::GetObject('Contact', $oTarget->Get('contact_id'), true, true /*allow all data*/);
				$this->SendQuizzToTargetContact($oContact);
			}
		}
		return true;
	}
	
	public function IsAnonymous()
	{
		$sModuleName = basename(dirname(__FILE__));
		$bAnonymous = (bool)MetaModel::GetModuleSetting($sModuleName, 'anonymous_survey', false);
		return $bAnonymous;
	}

	/**
	 * Send a preview message (with a link to a preview of the quizz) to the current user 
	 * @return void
	 */
	public function SendPreview($sStimulusCode)
	{
		$bRes = false;
		if ($oCurrentUser = UserRights::GetUserObject())
		{
			if ($iCurrentContact = $oCurrentUser->Get('contactid'))
			{
				if ($oCurrentContact = MetaModel::GetObject('Contact', $iCurrentContact, false, true /*allow all data*/))
				{
					try
					{
						$this->SendQuizzToContactLocalized($oCurrentContact);
						$bRes = true;
					}
					catch (Exception $e)
					{
						// $bRes remains false
					}
				}
			}
		}
		return $bRes;
	}

	/**
	 * Helper to return the targets whatever the visibility of the current user 
	 * @return object DBObjectSet
	 */
	public function GetTargetsFromDB()
	{
		// This is equivalent to returning
		// $this->Get('survey_target_list');
		// + Allow all data !
		// TO BE IMPROVED AS A GENERIC WAY TO SPECIFY "UNTIL FURTHER NOTICE I NEED EVERYTHING"
		
		$oSearch = DBObjectSearch::FromOQL_AllData('SELECT SurveyTarget WHERE survey_id = '.$this->GetKey());
		$oSet = new DBObjectSet($oSearch);
		return $oSet;
	}

	/**
	 * For a given target contact, prepare the anonymous (or not) answer and send an email 
	 * @param object $oContact Identifies the contact, then its email, etc.
	 * @return void
	 */
	protected function SendQuizzToTargetContact($oContact)
	{
		$oTargetAnswer = new SurveyTargetAnswer();
		$oTargetAnswer->Set('survey_id', $this->GetKey());
		$oTargetAnswer->Set('status', 'ongoing');
		if (!$this->IsAnonymous())
		{
			$oTargetAnswer->Set('contact_id',  $oContact->GetKey());
		}
		$sToken = $oTargetAnswer->SetToken();

		$oEvent = new SurveyNotification();
		$oEvent->Set('userinfo', UserRights::GetUser());
		$oEvent->Set('survey_id', $this->GetKey());
		$oEvent->Set('contact_id', $oContact->GetKey());

		$bRes = false;
		try
		{
			$this->SendQuizzToContactLocalized($oContact, $sToken);
			$oEvent->Set('message', Dict::S('Survey-email-ok'));
			$bRes = true;
		}
		catch (Exception $e)
		{
			$oEvent->Set('message', $e->getMessage());
		}

		if ($bRes)
		{
			// Create the anonymous (or not) answer
			$oTargetAnswer->Set('nb_notifications_sent', 1); // The first notification was sent successfully
			$oTargetAnswer->DBInsert();
		}

		// Keep track of the notification
		$oEvent->DBInsertNoReload();
	}

	/**
	 * For a given target contact, send again an invitation to answer the quizz 
	 * @param object $oSTA Identifies the survey target contact
	 * @param $sSubject Alternate email subject
	 * @param $sBody Alternate email body
	 * @return void
	 */
	public function SendAgainQuizzToTargetContact(SurveyTargetAnswer $oTargetAnswer, $sSubject, $sBody)
	{
		$sToken = $oTargetAnswer->Get('token');

		$oEvent = new SurveyNotification();
		$oEvent->Set('userinfo', UserRights::GetUser());
		$oEvent->Set('survey_id', $this->GetKey());
		$oEvent->Set('contact_id', $oTargetAnswer->Get('contact_id'));

		$bRes = false;
		try
		{
			$oContact = MetaModel::GetObject('Contact', $oTargetAnswer->Get('contact_id'));
			$this->SendQuizzToContactLocalized($oContact, $sToken, $sSubject, $sBody);
			$oEvent->Set('message', Dict::S('Survey-email-ok'));
			$oTargetAnswer->Set('nb_notifications_sent', 1 + (int)$oTargetAnswer->Get('nb_notifications_sent'));
			$bRes = true;
		}
		catch (Exception $e)
		{
			$oEvent->Set('message', $e->getMessage());
		}

		if ($bRes)
		{
			// Create the anonymous (or not) answer
			$oTargetAnswer->DBUpdate();
		}

		// Keep track of the notification
		$oEvent->DBInsertNoReload();
	}
	
   /**
	* Send the quizz and make sure the email and form are localized according to the language of the survey/quizz
	* @param object $oContact Target recipient
	* @param string $sToken Optional token; if omitted then the email and forms will be in preview mode		
	* @param string $sEmailBody Alternate email body
	* @param string $sEmailSubject Alternate email subject
	* @return void
	*/
	protected function SendQuizzToContactLocalized($oContact, $sToken = null, $sEmailSubject = null, $sEmailBody = null)
	{
		$oQuizz = MetaModel::GetObject('Quizz', $this->Get('quizz_id'), true, true /*allow all data*/);
		$oQuizz->ChangeDictionnaryLanguage();		
		try
		{
			$this->SendQuizzToContact($oQuizz, $oContact, $sToken, $sEmailSubject, $sEmailBody);
		}
		catch(Exception $e)
		{
			$oQuizz->RestoreDictionnaryLanguage();
			throw $e;		
		}
		$oQuizz->RestoreDictionnaryLanguage();
	}

	/**
	 * Prepare the email and send it
	 * @param object $oQuizz The quizz
	 * @param object $oContact The target contact
	 * @param string $sToken The token identifying the recipient for the anonymous answer ; if omitted, this is a sample email
	 * @param string $sEmailBody Alternate email body
	 * @param string $sEmailSubject Alternate email subject
	 * @return void
	 */
	protected function SendQuizzToContact($oQuizz, $oContact, $sToken = null, $sEmailSubject = null, $sEmailBody = null)
	{
		$oEmail = new EMail();

		$sQuizzUrl = $oQuizz->MakeFormUrl($sToken);

		if ($sEmailBody != null)
		{
			$sBody = $sEmailBody;
		}
		else
		{
			$sBody = $this->Get('email_body');
		}
		$sBody .= '<br/><a href="'.$sQuizzUrl.'">'.Dict::S('Survey-notif-linktoquizz').'</a>';

		if ($sEmailSubject != null)
		{
			$sSubject = $sEmailSubject;
		}
		else
		{
			$sSubject = $this->Get('email_subject');
		}
		
		if ($sToken)
		{
			$oEmail->SetSubject($sSubject);
		}
		else
		{
			$oEmail->SetSubject('['.Dict::S('Survey-email-preview').'] '.$sSubject);
		}
		$oEmail->SetBody($sBody);
		$oEmail->SetRecipientTO($oContact->Get('email'));

		$oSender = MetaModel::GetObject('Contact', $this->Get('on_behalf_of'), true, true /*allow all data*/);
		$sFrom = $oSender->Get('email');
		$oEmail->SetRecipientFrom($sFrom);
		//$oEmail->SetRecipientReplyTo($sReplyTo);
		//$oEmail->SetReferences();
		//$oEmail->SetMessageId();

		$iRes = $oEmail->Send($aErrors, false); // allow asynchronous mode
		switch ($iRes)
		{
			case EMAIL_SEND_OK:
				return;

			case EMAIL_SEND_PENDING:
				return;

			case EMAIL_SEND_ERROR:
				throw new Exception(Dict::S('Survey-email-notsent').': '.implode(', ', $aErrors));
		}
	}


	/**
	 * In state running, detect new target contacts and align them to already existing contacts
	 * @return void
	 */
	protected function OnUpdate()
	{
		if ($this->Get('status') == 'running')
		{
			// Detect new users and send them a notification
			// A contact is considered as "new" if he/she was never
			// sent a notification to participate in this survey
			$oSearch = new DBObjectSearch('SurveyNotification');
			$oSearch->AddCondition('survey_id', $this->GetKey());
			$oNotificationsSent = new DBObjectSet($oSearch);
			$aNotifs = array();
			while($oNotification = $oNotificationsSent->Fetch())
			{
				//TODO: check if the notification was successful ?
				//      so that we can retry in case of error...
				$aNotifs[$oNotification->Get('contact_id')] = true;
			}
			 
			$oNewTargetSet = $this->Get('survey_target_list');
			$aNewSet = $oNewTargetSet->ToArray();

			foreach($aNewSet as $iId => $oTarget)
			{
				if (!array_key_exists($oTarget->Get('contact_id'), $aNotifs))
				{
					$oContact = MetaModel::GetObject('Contact', $oTarget->Get('contact_id'));
					$this->SendQuizzToTargetContact($oContact);
				}
			}			
		}
	}


	/**
	 * Add a tab with progress information, statistics and links to usefull queries for reporting
	 * @param object $oPage Page
	 * @param bool	$bEditMode True in edition, false in read-only mode
	 * @return void
	 */
	function DisplayBareRelations(WebPage $oPage, $bEditMode = false)
	{
		parent::DisplayBareRelations($oPage, $bEditMode);
		if (!$bEditMode)
		{
			if ($this->Get('status') != 'new')
			{
				$this->DisplayProgressTab($oPage);
				$this->DisplayResultsTab($oPage);
			}		
		}
	}

	protected function DisplayProgressTab($oPage)
	{
		$oTargetSet = $this->Get('survey_target_answer_list');
		$iTargetCount = $oTargetSet->Count();

		$oFilter = new DBObjectSearch('SurveyTargetAnswer');
		$oFilter->AddCondition('survey_id', $this->GetKey());
		$oFilter->AddCondition('status', 'finished');
		$oFinishedSet = new DBObjectSet($oFilter);
		$iAnswerCount = $oFinishedSet->Count();

		$iAwaited = $iTargetCount - $iAnswerCount;

		if ($iTargetCount > 0)
		{
			$iProgress = round(100 * $iAnswerCount / $iTargetCount);
		}
		else
		{
			$iProgress = 100;
		}
		$oPage->SetCurrentTab(Dict::S('Survey-tab-progress').' ('.$iProgress.' %)');
		$oPage->p(Dict::S('Survey-awaited-answers').': '.$iAwaited);

		if (!$this->IsAnonymous())
		{
			$oPage->add('<h1>'.Dict::S('Survey-progress-status').'</h1>');

			$oFilter = new DBObjectSearch('SurveyTargetAnswer');
			$oFilter->AddCondition('survey_id', $this->GetKey());
			$oBlock = new DisplayBlock($oFilter, 'list');
			
			// mark all "finished" targets as non-selectable
			$oFinishedFilter = new DBObjectSearch('SurveyTargetAnswer');
			$oFinishedFilter->AddCondition('survey_id', $this->GetKey());
			$oFinishedFilter->AddCondition('status', 'finished');
			$oSet = new DBObjectSet($oFinishedFilter);
			$aSelectable = array();
			while($oSTA = $oSet->Fetch())
			{
				$aSelectable[$oSTA->GetKey()] = false;
			}
			$aExtraParams = array(
				'menu' => '0',
				'table_id' => 'survey-progress-status',
				'view_link' => false,
				'zlist' => false,
				'extra_fields' => 'contact_id,nb_notifications_sent,status,date_response',
				'selection_mode' => true,
				'selection_enabled' => $aSelectable,
			);
			$sBlockId = 'block-survey-progress-status';
			$oBlock->Display($oPage, $sBlockId, $aExtraParams);

			$sWithSelected = addslashes('<div>'.Dict::S('Survey-With-Selected').'<input type="button" id="survey_send_again" value="'.Dict::S('Survey-Resend-Button').'"></div>');

			$sDialogId = "survey_resend_dialog";
			$sDialogTitle = addslashes(Dict::S('Survey-Resend-Title'));
			$sOkButtonLabel = addslashes(Dict::S('Survey-Resend-Ok'));
			$sCancelButtonLabel = addslashes(Dict::S('Survey-Resend-Cancel'));

			$oPage->add('<div id="'.$sDialogId.'" style="display: none;">');
			$oForm = new DesignerForm();
			$oField = new DesignerTextField('email_subject', Dict::S('Class:Survey/Attribute:email_subject'), $this->Get('email_subject'));
			$oField->SetMandatory(true);
			$oForm->AddField($oField);
			$oField = new DesignerLongTextField('email_body', Dict::S('Class:Survey/Attribute:email_body'), $this->Get('email_body'));
			$oField->SetMandatory(true);
			$oForm->AddField($oField);
			$oForm->Render($oPage);
			$oPage->add('</div>');

			$iSurveyId = $this->GetKey();
			$sAjaxUrl = addslashes(utils::GetAbsoluteUrlModulesRoot().'customer-survey/ajax.survey.php');

			$oPage->add_ready_script(
<<<EOF
function SurveyRunDialogSendAgain()
{
	$('#$sDialogId textarea').ckeditor();
	$('#$sDialogId input[type=text]').attr('size', 50);
	$('#$sDialogId').dialog({
		height: 'auto',
		width: 'auto',
		modal: true,
		title: '$sDialogTitle',
		buttons: [
		{ text: "$sOkButtonLabel", click: function() {
			if ($('#$sDialogId .ui-state-error').length == 0)
			{
				var aTargets = [];
				$('#block-survey-progress-status .datacontents .selectListblock_survey_progress_status:checked').each(function () {
					aTargets.push($(this).val());
				});

				var sEmailSubject = $('#$sDialogId #attr_email_subject').val();
				var sEmailBody = $('#$sDialogId #attr_email_body').val();
				var oMap = {
					operation: 'send_again',
					survey_id: $iSurveyId,
					email_subject: sEmailSubject,
					email_body: sEmailBody,
					targets: aTargets
				};
				$(this).dialog('close');
				$('#SurveyEmailNotifications_indicator').html('<img src="../images/indicator.gif"/>')

				var sUrl = '$sAjaxUrl';

				$.post(sUrl, oMap, function(data) {
					// Refresh the list of notifications
					$('#SurveyEmailNotifications').html(data);
				});

			}
		} },
		{ text: "$sCancelButtonLabel", click: function() {
			$(this).dialog( "close" );
		} },
		],
	});
}
$('#block-survey-progress-status .datacontents').append('$sWithSelected');
$('#survey_send_again').attr('disabled', 'disabled');

$('#block-survey-progress-status .selectListblock_survey_progress_status').change(function (){
	if ($('#block-survey-progress-status .selectListblock_survey_progress_status:checked').length > 0)
	{
		$('#survey_send_again').removeAttr('disabled');
	}
	else
	{
		$('#survey_send_again').attr('disabled', 'disabled');
	}
});

$('#survey_send_again').click(function (){
	SurveyRunDialogSendAgain();
});
EOF
			);
		}
		$oPage->add('<div id="SurveyEmailNotifications">');
		$this->DisplayNotifications($oPage);
		$oPage->add('</div>');
	}
	
	public function DisplayNotifications(WebPage $oPage)
	{
		$oPage->add('<h1>'.Dict::S('Survey-progress-notifications').'&nbsp;<span id="SurveyEmailNotifications_indicator"></span></h1>');
		$oFilter = new DBObjectSearch('SurveyNotification');
		$oFilter->AddCondition('survey_id', $this->GetKey());
		$oBlock = new DisplayBlock($oFilter, 'list');
		$aExtraParams = array(
			'menu' => '0',
			'table_id' => 'survey-progress-notif',
			'view_link' => false,
			'zlist' => false,
			'extra_fields' => 'contact_id,date,message'
		);
		$sBlockId = 'block-survey-progress-notif';
		$oBlock->Display($oPage, $sBlockId, $aExtraParams);		
	}

	public function DisplayResultsTab($oPage, $bPrintable = false, $aOrgIds = array(), $aContactIds = array())
	{
		if (!$bPrintable)
		{
			$oPage->SetCurrentTab(Dict::S('Survey-tab-results'));
		}
		
		if (!$this->IsAnonymous() && !$bPrintable)
		{
			$sOQL = 'SELECT Organization AS O JOIN Contact AS C ON C.org_id = O.id JOIN SurveyTargetAnswer AS T ON T.contact_id = C.id WHERE T.survey_id = '.$this->GetKey();
			$oSet = new DBObjectSet(DBObjectSearch::FromOQL($sOQL));
			$aAllowedValues = array();
			while($oOrg = $oSet->Fetch())
			{
				$aAllowedValues[$oOrg->GetKey()] = $oOrg->GetName();
			}
			$sHtml = $this->GetDropDownFilter('filter_stats_org_id', Dict::S('Survey-results-filter-organization'), $aAllowedValues,'org_id', '');
			
			$sHtml .= '<span id="filter_stats_contact_id_outer">'.$this->GetContactsFilter().'</span>';
			$oPage->add('<fieldset><legend>'.Dict::S('Survey-results-fitlering').'</legend><div id="stats_filter">');
			$oPage->add($sHtml);
			$oPage->add('<button id="stats_filter_apply" type="button">'.Dict::S('Survey-results-apply-filter').'</button>&nbsp;<span id="stats_filter_indicator"></span>');
			$oPage->add('</div></fieldset>');
		}
		
		$oPage->add('<div id="survey_stats">');
		$this->DisplayStatisticsAndExport($oPage, $bPrintable, $aOrgIds, $aContactIds);
		$oPage->add('</div>');
		$iSurveyId = $this->GetKey();
		$sAjaxUrl = addslashes(utils::GetAbsoluteUrlModulesRoot().'customer-survey/ajax.survey.php');
		$oPage->add_ready_script(
<<<EOF
function SurveyFilterStats()
{
	$('#stats_filter button').attr('disabled', 'disabled');
	$('#stats_filter_indicator').html('<img src="../images/indicator.gif"/>');
	var oMap = {
		operation: 'filter_stats',
		survey_id: $iSurveyId,
		org_id: $('#filter_stats_org_id').val(),
		contact_id: $('#filter_stats_contact_id').val()
	}
	$.post('$sAjaxUrl', oMap, function(html) {
	
		$('#survey_stats').html(html);
		$('#stats_filter_indicator').html('');
		$('#stats_filter button').removeAttr('disabled');
	});
}
function RefreshContactsFilter()
{
	$('#stats_filter button').attr('disabled', 'disabled');
	$('#stats_filter_indicator').html('<img src="../images/indicator.gif"/>');
	var oMap = {
		operation: 'refresh_contacts_filter',
		survey_id: $iSurveyId,
		org_id: $('#filter_stats_org_id').val()
	};
	$.post('$sAjaxUrl', oMap, function(html) {
	
		$('#filter_stats_contact_id_outer').html(html);
		$('#stats_filter_indicator').html('');
		$('#stats_filter button').removeAttr('disabled');
	});
}

$('#filter_stats_org_id').bind('change', RefreshContactsFilter);
$('#stats_filter_apply').click(SurveyFilterStats);
EOF
		);
		if ($bPrintable)
		{
			$oPage->add_style("body { overflow: auto; }");
			$oPage->add_ready_script(
<<<EOF
$('div.Collapsible').toggleClass('open');
EOF
			);
		}
	}
	
	public function DisplayStatisticsAndExport(WebPage $oPage, $bPrintable = false, $aOrgIds = array(), $aContactIds = array())
	{
		$sFields = 'question_title,question_description,value';
		$sOrgIdClause = '';
		$sOrgUrl = '';
		if (count($aOrgIds) > 0)
		{
			$sOrgIdClause = " AND T.org_id IN(".implode(',', $aOrgIds).")";
			foreach($aOrgIds as $iOrgId)
			{
				$sOrgUrl .= '&o[]='.$iOrgId;
			}
		}
		$sContactIdClause = '';
		$sContactUrl = '';
		if (count($aContactIds) > 0)
		{
			$sContactIdClause = " AND T.contact_id IN(".implode(',', $aContactIds).")";
			foreach($aContactIds as $iContactId)
			{
				$sContactUrl .= '&c[]='.$iContactId;
			}
		}
		if (!$this->IsAnonymous())
		{
			$sFields .= ',contact_name,org_name';
		}
		$sOQL = "SELECT SurveyTargetAnswer AS T WHERE T.survey_id = ".$this->GetKey();
		$sOQL .= $sOrgIdClause.$sContactIdClause;
		$oFilter = DBObjectSearch::FromOQL_AllData($sOQL);
		$oTargetSet = new DBObjectSet($oFilter);
		$iTargetCount = $oTargetSet->Count();
		
		$oPage->add('<div class="survey-stats">');
		if ( (count($aContactIds) > 0) || (count($aOrgIds) > 0))
		{
			$sFieldsetLegend = Dict::S('Survey-results-statistics-filtered');
		}
		else
		{
			$sFieldsetLegend = Dict::S('Survey-results-statistics');
		}
		$oPage->add("<fieldset style=\"background: #FFFFFF;\"><legend>$sFieldsetLegend</legend>");
		if (!$bPrintable)
		{
			$sUrl = utils::GetAbsoluteUrlModulePage('customer-survey', 'print.php');
			$oPage->add('<div style="float:right"><form id="printable_version" method="post" target="_blank" action="'.$sUrl.'">');
			$aVars = array('operation' => 'print_results', 'survey_id' => $this->GetKey(), 'org_id' => $aOrgIds, 'contact_id' => $aContactIds);
			foreach($aVars as $sName => $value)
			{
				if (is_array($value))
				{
					foreach($value as $sVal)
					{
						$oPage->add('<input type="hidden" name="'.$sName.'[]" value="'.$sVal.'"/>');
					}
				}
				else
				{
					$oPage->add('<input type="hidden" name="'.$sName.'" value="'.$value.'"/>');
				}			
			}
			$oPage->add('<a href="#" onclick="$(\'#printable_version\').submit(); return false;">'.Dict::S('Survey-results-print').'</a></form></div>');
		}

		$sOQL = "SELECT SurveyTargetAnswer AS T WHERE T.status = 'finished' AND T.survey_id = ".$this->GetKey();
		$sOQL .= $sOrgIdClause.$sContactIdClause;
		$oFilter = DBObjectSearch::FromOQL_AllData($sOQL);
		$oFinishedSet = new DBObjectSet($oFilter);

		$iAnswerCount = $oFinishedSet->Count();
		if ($iAnswerCount > 0)
		{
			$oPage->add(Dict::Format('Survey-results-completion_X_out_of_Y_Percent', $iAnswerCount, $iTargetCount, sprintf('%.2f', $iAnswerCount/$iTargetCount*100.0)));
			
			$sOQL = "SELECT QuizzElement AS QE JOIN Quizz AS Q ON QE.quizz_id = Q.id JOIN Survey AS S ON S.quizz_id = Q.id JOIN SurveyTargetAnswer AS T ON T.survey_id = S.id WHERE T.status = 'finished' AND S.id = ".$this->GetKey();
			$sOQL .= $sOrgIdClause.$sContactIdClause;
			$oQuestionSearch = DBObjectSearch::FromOQL_AllData($sOQL);
			$oQuestionSet = new DBObjectSet($oQuestionSearch);
			while ($oQuestion = $oQuestionSet->Fetch())
			{
				
				$oPage->add('<div>');
				
				$sOQL = "SELECT SurveyAnswer AS A JOIN SurveyTargetAnswer AS T ON A.survey_target_id = T.id WHERE T.status = 'finished' AND A.question_id = ".$oQuestion->GetKey().' AND T.survey_id = '.$this->GetKey();
				$sOQL .= $sOrgIdClause.$sContactIdClause;
				$oAnswerSearch = DBObjectSearch::FromOQL_AllData($sOQL);
				$oAnswerSet = new DBObjectSet($oAnswerSearch);
				
				$oQuestion->DisplayResults($oPage, $oAnswerSet, $iTargetCount, $this->IsAnonymous());						
	
				$oPage->add('</div>');
				
			}
			$oPage->add('</div>');
		}
		else
		{
			$oPage->p(Dict::S('Survey-results-noanswer'));
		}
		$oPage->add('</fieldset>');
		$oPage->add('</div>');
	
		if (!$bPrintable)
		{
			$oPage->add('<fieldset><legend>'.Dict::S('Survey-query-results-export').'</legend>');
			$oPage->add('<table>');
			$oPage->add('<tr>');
			$oPage->add('<td>'.Dict::S('Survey-query-results').'</td>');
	
			$sAbsoluteUrl = utils::GetAbsoluteUrlModulesRoot();
	
			$sRunQueryUrl = $sAbsoluteUrl.'customer-survey/report.php?s='.$this->GetKey().$sOrgUrl.$sContactUrl;
			$oPage->add('<td><a href="'.$sRunQueryUrl.'" target="_blank">'.Dict::S('Survey-results-excel').'</a></td>');
	
			$sRunQueryUrl .= '&f=csv';
			$oPage->add('<td><a href="'.$sRunQueryUrl.'" target="_blank">'.Dict::S('Survey-results-csv').'</a></td>');
	
			$oPage->add('</tr>');

			$oPage->add('</table>');
			$oPage->add('</fieldset>');
		}
	}
	
	public function GetContactsFilter($aOrganizations = array())
	{
		$sOQL = 'SELECT Contact AS C JOIN SurveyTargetAnswer AS T ON T.contact_id = C.id WHERE T.survey_id = '.$this->GetKey();
		if (count($aOrganizations) > 0)
		{
			$sOQL .= ' AND C.org_id IN('.implode(',', $aOrganizations).')';
		}
		$oSet = new DBObjectSet(DBObjectSearch::FromOQL($sOQL));
		$aAllowedValues = array();
		while($oContact = $oSet->Fetch())
		{
			$aAllowedValues[$oContact->GetKey()] = $oContact->GetName();
		}
		return $this->GetDropDownFilter('filter_stats_contact_id', Dict::S('Survey-results-filter-contact'), $aAllowedValues,'contact_id', '');
	}
	
	protected function GetDropDownFilter($sId, $sLabel, $aAllowedValues, $sFilterCode, $sFilterValue = '')
	{
		//Enum field, display a multi-select combo
		$sValue = "<select id=\"$sId\" class=\"multiselect\" size=\"1\" name=\"{$sFilterCode}[]\" multiple>\n";
		foreach($aAllowedValues as $key => $value)
		{
			if (is_array($sFilterValue) && in_array($key, $sFilterValue))
			{
				$sSelected = ' selected';
			}
			else if ($sFilterValue == $key)
			{
				$sSelected = ' selected';
			}
			else
			{
				$sSelected = '';
			}
			$sValue .= "<option value=\"$key\"$sSelected>$value</option>\n";
		}
		$sValue .= "</select>\n";
		return "<label>$sLabel:</label>&nbsp;$sValue\n";		
	}
}

/**
 *
 * SurveyTarget: a target of a survey
 *
 */
class SurveyTarget extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,survey",
			"key_type" => "autoincrement",
			"name_attcode" => array("contact_id_friendlyname"),
			"state_attcode" => "",
			"reconc_keys" => array("survey_id_friendlyname", "contact_id_friendlyname"),
			"db_table" => "qz_survey_target",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("survey_id", array("targetclass"=>"Survey", "jointype"=>null, "allowed_values"=>null, "sql"=>"survey_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("contact_id", array("targetclass"=>"Contact", "jointype"=>null, "allowed_values"=>null, "sql"=>"contact_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('survey_id', 'contact_id'));
		MetaModel::Init_SetZListItems('standard_search', array('survey_id', 'contact_id'));
		MetaModel::Init_SetZListItems('list', array('survey_id', 'contact_id'));
	}
}

/**
 *
 * SurveyTargetAnswer: an anonymous target of a survey
 *
 */
class SurveyTargetAnswer extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,survey",
			"key_type" => "autoincrement",
			"name_attcode" => array("token"),
			"state_attcode" => "",
			"reconc_keys" => array("token", "survey_id_friendlyname"),
			"db_table" => "qz_survey_targetanswer",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("survey_id", array("targetclass"=>"Survey", "jointype"=>null, "allowed_values"=>null, "sql"=>"survey_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("token", array("allowed_values"=>null, "sql"=>"token", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDateTime("date_response", array("allowed_values"=>null, "sql"=>"date_response", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		//MetaModel::Init_AddAttribute(new AttributeLinkedSet("survey_answer_list", array("linked_class"=>"SurveyAnswer", "ext_key_to_me"=>"survey_target_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("contact_id", array("targetclass"=>"Contact", "jointype"=>null, "allowed_values"=>null, "sql"=>"contact_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contact_name", array("allowed_values"=>null, "extkey_attcode"=> 'contact_id', "target_attcode"=>"friendlyname")));
		
		MetaModel::Init_AddAttribute(new AttributeExternalField("org_id", array("allowed_values"=>null, "extkey_attcode"=> 'contact_id', "target_attcode"=>"org_id")));
		MetaModel::Init_AddAttribute(new AttributeExternalField("org_name", array("allowed_values"=>null, "extkey_attcode"=> 'contact_id', "target_attcode"=>"org_name")));

		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum('ongoing,finished'), "sql"=>"status", "default_value"=>"finished", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("nb_notifications_sent", array("allowed_values"=>null, "sql"=>"nb_notifications_sent", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("last_question_id", array("targetclass"=>"QuizzElement", "jointype"=>null, "allowed_values"=>null, "sql"=>"last_question_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		
		MetaModel::Init_SetZListItems('details', array('survey_id', 'date_response'));
		MetaModel::Init_SetZListItems('standard_search', array('survey_id', 'date_response'));
		MetaModel::Init_SetZListItems('list', array('contact_id', 'nb_notifications_sent', 'status', 'date_response'));
	}

	public function SetToken()
	{
		// Note: uniqid is based on the curent time + an internal counter that ensures a new value at each call
		$sToken = $this->Get('survey_id').'-'.uniqid();
		$this->Set('token', $sToken);
		return $sToken;
	}
}

/**
 *
 * SurveyAnswer: the answer of one target to a given question of a survey
 *
 */
class SurveyAnswer extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,survey",
			"key_type" => "autoincrement",
			"name_attcode" =>  array("survey_target_id_friendlyname", "question_id"),
			"state_attcode" => "",
			"reconc_keys" => array("survey_target_id_friendlyname", "question_id"),
			"db_table" => "qz_survey_answer",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("survey_target_id", array("targetclass"=>"SurveyTargetAnswer", "jointype"=>null, "allowed_values"=>null, "sql"=>"survey_target_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("question_id", array("targetclass"=>"QuizzElement", "jointype"=>null, "allowed_values"=>null, "sql"=>"question_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("question_title", array("allowed_values"=>null, "extkey_attcode"=> 'question_id', "target_attcode"=>"title")));
		MetaModel::Init_AddAttribute(new AttributeExternalField("question_description", array("allowed_values"=>null, "extkey_attcode"=> 'question_id', "target_attcode"=>"description")));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contact_id", array("allowed_values"=>null, "extkey_attcode"=> 'survey_target_id', "target_attcode"=>"contact_id")));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contact_name", array("allowed_values"=>null, "extkey_attcode"=> 'survey_target_id', "target_attcode"=>"contact_name")));
		MetaModel::Init_AddAttribute(new AttributeExternalField("org_id", array("allowed_values"=>null, "extkey_attcode"=> 'survey_target_id', "target_attcode"=>"org_id")));
		MetaModel::Init_AddAttribute(new AttributeExternalField("org_name", array("allowed_values"=>null, "extkey_attcode"=> 'survey_target_id', "target_attcode"=>"org_name")));
		//MetaModel::Init_AddAttribute(new AttributeInteger("value", array("allowed_values"=>null, "sql"=>"value", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("value", array("allowed_values"=>null, "sql"=>"value", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		
		MetaModel::Init_SetZListItems('details', array('survey_target_id', 'question_id', 'value'));
		MetaModel::Init_SetZListItems('standard_search', array('survey_target_id', 'question_id', 'value'));
		MetaModel::Init_SetZListItems('list', array('survey_target_id', 'question_id', 'value'));
	}
}


/**
 *
 * Log of notifications sent to target contacts
 *
 */
class SurveyNotification extends Event
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "core/cmdb,view_in_gui",
			"key_type" => "autoincrement",
			"name_attcode" => "",
			"state_attcode" => "",
			"reconc_keys" => array(),
			"db_table" => "qz_event_notification",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
			'order_by_default' => array('date' => false),
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("survey_id", array("targetclass"=>"Survey", "jointype"=> "", "allowed_values"=>null, "sql"=>"survey_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("contact_id", array("targetclass"=>"Contact", "jointype"=> "", "allowed_values"=>null, "sql"=>"contact_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));

		// Display lists
		MetaModel::Init_SetZListItems('details', array('survey_id', 'userinfo', 'contact_id', 'date', 'message')); // Attributes to be displayed for the complete details
		MetaModel::Init_SetZListItems('list', array('contact_id', 'date', 'message')); // Attributes to be displayed for a list
	}
}

/*
*
* Menus
*
*/
class CustomerSurvey extends ModuleHandlerAPI
{
	public static function OnMenuCreation()
	{
		$oMainMenu = new MenuGroup('RequestManagement', 30 /* fRank */);
		$oQuizzMenu = new TemplateMenuNode('CustomerSurvey', '', $oMainMenu->GetIndex(), 50 /* fRank */);
		$iIndex = 1;
		new OQLMenuNode('Quizzes', 'SELECT Quizz', $oQuizzMenu->GetIndex(), $iIndex++ /* fRank */);
		new OQLMenuNode('Surveys', 'SELECT Survey', $oQuizzMenu->GetIndex(), $iIndex++ /* fRank */);
	}
}
