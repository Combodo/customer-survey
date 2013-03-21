<?php
// Copyright (C) 2011 Combodo SARL
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
			"category" => "searchable,quizz",
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
		MetaModel::Init_AddAttribute(new AttributeText("introduction", array("allowed_values"=>null, "sql"=>"introduction", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeInteger("min_value", array("allowed_values"=>null, "sql"=>"min_value", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeString("min_label", array("allowed_values"=>null, "sql"=>"min_label", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeInteger("max_value", array("allowed_values"=>null, "sql"=>"max_value", "default_value"=>10, "is_null_allowed"=>false, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeString("max_label", array("allowed_values"=>null, "sql"=>"max_label", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeString("above_labels", array("allowed_values"=>null, "sql"=>"above_labels", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
//		MetaModel::Init_AddAttribute(new AttributeEnum("comments", array("allowed_values"=>new ValueSetEnum('yes,no'), "sql"=>"comments", "default_value"=>"yes", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("scale_values", array("allowed_values"=>null, "sql"=>"scale_values", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSet("survey_list", array("linked_class"=>"Survey", "ext_key_to_me"=>"quizz_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSet("question_list", array("linked_class"=>"QuizzElement", "ext_key_to_me"=>"quizz_id", "edit_mode" => LINKSET_EDITMODE_INPLACE, "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

//		MetaModel::Init_AddAttribute(new AttributeText("default_message", array("allowed_values"=>null, "sql"=>"default_message", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array(
				'survey_list',
				'question_list',
				'col:0'=> array('fieldset:Survey-quizz-frame-definition' => array('name','description', 'language', 'scale_values'), 'fieldset:Survey-quizz-frame-description' => array('title','introduction')),
		));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'description', 'language', 'title', 'introduction'));
		MetaModel::Init_SetZListItems('list', array('description', 'language'));
	}


	/*
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
			$oPage->p(Dict::S('Survey-quizz-shortcuttoquizz').': <a href="'.$this->MakeFormUrl().'">'.Dict::S('Survey-quizz-shortcutlabel').'</a>');
		}
	}

	/*
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
			// Draft
			$sUrl = $sAbsoluteUrl.'customer-survey/run_survey.php?operation=test&quizz_id='.$this->GetKey();
		}
		return $sUrl;
	}

	/*
	 * Build the form
	 * @param object $oP Target page
	 * @param object $oSurvey Optional survey if running a survey
	 * @param object $oTarget Optional anonymous record (given if the survey has been specified) 
	 * @return void
	 */
	function ShowForm($oP, $oSurvey = null, $oTarget = null)
	{
		/*
		$aChoices = array(); // Array of value => label
		$aValueAttDef = MetaModel::GetAttributeDef('SurveyAnswer', 'value');
		foreach ($aValueAttDef->GetAllowedValues() as $sKey => $value)
		{
			$aChoices[$sKey] = $value;
		}
		*/

		// Build the form
		//
		$oP->add("<h1>".$this->GetAsHtml('title')."</h1>\n");
		$oP->add("<p>".$this->GetAsHtml('introduction')."</p>\n");
	
		$oP->add("<div class=\"wizContainer\" id=\"form_close_request\">\n");
		$oP->add("<form action=\"\" id=\"quizz_form\" method=\"post\" onSubmit=\"return CheckQuizzForm()\">\n");
	
		$oP->add("<input type=\"hidden\" name=\"operation\" value=\"submit_answers\">");
		if ($oTarget)
		{
			$sToken = $oTarget->Get('token');
			$oP->add("<input type=\"hidden\" name=\"token\" value=\"$sToken\">");
		}

		$bHasMandatoryQuestions = false;
		$oQuestionSet = $this->Get('question_list');
		while($oQuestion = $oQuestionSet->Fetch())
		{
			$oQuestion->DisplayForm($oP, ''); //TODO: retrieve the previously saved values
			if ($oQuestion->Get('mandatory') == 'yes')
			{
				$bHasMandatoryQuestions = true;
			}
		}
	
		$oP->add("<div class=\"quizzQuestion\">");
		$oP->add("<h3>".Dict::S('Survey-form-comments')."</h3>");
		$oP->add("<TEXTAREA style=\"width: 100%;\" name=\"comment\" value=\"\"></TEXTAREA>");
		$oP->add("</div>");

		if ($oTarget)
		{
			$oP->add("<INPUT type=\"submit\" name=\"foo\" value=\"".Dict::S('Survey-form-submit')."\">");
		}
		else
		{
			$oP->add("<INPUT type=\"submit\" name=\"foo\" value=\"".Dict::S('Survey-form-submit')."\" DISABLED>");
		}
	
		$oP->add("</form>");
		$oP->add("</div>");
		if ($bHasMandatoryQuestions)
		{		
			$oP->p("<span class=\"mandatory_asterisk\">*</span> ".Dict::S('Survey-MandatoryQuestion'));
			$sMissingMandatory = Dict::S('Survey-missing-answers');
			$oP->add_script(
<<<EOF
function CheckQuizzForm()
{
	bOk = true;

	$('div.quizzQuestion').each( function() {
		iQuestionId = this.id;
		$(this).find('span.mandatory_asterisk').each(function() {
			value = $("input[name=answer["+iQuestionId+"]]:checked").val();
			if (bOk && !value)
			{
				// question #iQuestionId is missing
				alert("$sMissingMandatory");
				bOk = false;
			}
		});
	});
	return bOk;
}
EOF
			);
		}
		else
		{
			$oP->add_script('function CheckQuizzForm(){return true;}');
		}
	}

	/*
	 * Change the current language to the language of the quizz
	 * @return void
	 */
	public function ChangeDictionnaryLanguage()
	{
		$this->m_sApplicationLanguage = Dict::GetUserLanguage();
		Dict::SetUserLanguage($this->Get('language'));
	}

	/*
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
			"category" => "searchable,quizz",
			"key_type" => "autoincrement",
			"name_attcode" => array("order", "title"),
			"state_attcode" => "",
			"reconc_keys" => array("quizz_id_friendlyname", "order"),
			"db_table" => "qz_element",
			"db_key_field" => "id",
			"db_finalclass_field" => "finalclass",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("quizz_id", array("targetclass"=>"Quizz", "jointype"=>null, "allowed_values"=>null, "sql"=>"quizz_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("order", array("allowed_values"=>null, "sql"=>"order", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("title", array("allowed_values"=>null, "sql"=>"title", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("mandatory", array("allowed_values"=>new ValueSetEnum('yes,no'), "sql"=>"mandatory", "default_value"=>"yes", "is_null_allowed"=>false, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('quizz_id', 'order', 'title', 'description', 'mandatory'));
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
	abstract public function DisplayResults(WebPage $oPage, DBObjectSet $oSet);
	
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
			$oPage->add("<h3>$sTitle <span class=\"mandatory_asterisk\" title=\"".Dict::S('Survey-MandatoryQuestion')."\">*</span></h3>");
		}
		else
		{
			$oPage->add("<h3>$sTitle</h3>");
		}
		$oPage->add("<p>$sDescription</p>");

		$sTDProps = "width=\"80px\" align=\"center\"";

		$oPage->add("<table>");

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
}

class QuizzScaleQuestion extends QuizzElement
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "searchable,quizz",
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
	
	public function DisplayResults(WebPage $oPage, DBObjectSet $oSet)
	{
		
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
	public static function Init()
	{
		$aParams = array
		(
			"category" => "searchable,quizz",
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
			$oPage->add("<h3>$sTitle <span class=\"mandatory_asterisk\" title=\"".Dict::S('Survey-MandatoryQuestion')."\">*</span></h3>");
		}
		else
		{
			$oPage->add("<h3>$sTitle</h3>");
		}
		$sMandatory = ($this->Get('mandatory') == 'yes') ? 'true' : 'false';
		$oPage->add("<p>$sDescription</p>");
		$oPage->add('<TEXTAREA style="width:100%;" name="answer['.$iQuestionId.']" data-mandatory="'.$sMandatory.'">'.htmlentities($sCurrentValue, ENT_QUOTES, 'UTF-8').'</TEXTAREA>');
	}
	
	public function DisplayResults(WebPage $oPage, DBObjectSet $oSet)
	{
		
	}
}


class QuizzNewPageElement extends QuizzElement
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "searchable,quizz",
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
		$sTitle = $this->GetAsHtml('title');
		$sDescription = $this->GetAsHtml('description');
		$oPage->add("<hr/>");
		$oPage->add("<h3>$sTitle</h3>");
		$oPage->add("<p>$sDescription</p>");
	}
	public function DisplayResults(WebPage $oPage, DBObjectSet $oSet)
	{
		
	}
	
	public function HasValue()
	{
		return false;
	}
	
	public function IsNewPage()
	{
		return true;
	}
}

class QuizzValueQuestion extends QuizzElement
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "searchable,quizz",
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
	public function DisplayResults(WebPage $oPage, DBObjectSet $oSet)
	{
		
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
	}}

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
			"category" => "searchable,survey",
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

		MetaModel::Init_AddAttribute(new AttributeString("email_subject", array("allowed_values"=>null, "sql"=>"email_subject", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("email_body", array("allowed_values"=>null, "sql"=>"email_body", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("survey_target_list", array("linked_class"=>"SurveyTarget", "ext_key_to_me"=>"survey_id", "ext_key_to_remote"=>"contact_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSet("survey_target_answer_list", array("linked_class"=>"SurveyTargetAnswer", "ext_key_to_me"=>"survey_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

		MetaModel::Init_AddAttribute(new AttributeLinkedSet("notification_list", array("linked_class"=>"SurveyNotification", "ext_key_to_me"=>"survey_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('quizz_id', 'language', 'status', 'date_sent', 'on_behalf_of', 'email_subject', 'email_body', 'target_phrase_id', 'survey_target_list', 'notification_list'));
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

		MetaModel::Init_DefineTransition("new", "ev_test", array("target_state"=>"new", "actions"=>array('SendPreview'), "user_restriction"=>null));
		MetaModel::Init_DefineTransition("new", "ev_start", array("target_state"=>"running", "actions"=>array('SendQuizz'), "user_restriction"=>null));
		MetaModel::Init_DefineTransition("running", "ev_test", array("target_state"=>"running", "actions"=>array('SendPreview'), "user_restriction"=>null));
		MetaModel::Init_DefineTransition("running", "ev_close", array("target_state"=>"closed", "actions"=>array(), "user_restriction"=>null));
	}

	protected $m_sApplicationLanguage;

	// Lifecycle actions
	//
	public function SendQuizz($sStimulusCode)
	{
		$this->Set('date_sent', time());

		$oTargetSet = $this->GetTargetsFromDB();
		while($oTarget = $oTargetSet->Fetch())
		{
			$this->SendQuizzToTarget($oTarget);
		}
		return true;
	}

	/*
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

	/*
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

	/*
	 * For a given target contact, prepare the anonymous answer and send an email 
	 * @param object $oTarget Identifies the contact, then its email, etc.
	 * @return void
	 */
	protected function SendQuizzToTarget($oTarget)
	{
		$oContact = MetaModel::GetObject('Contact', $oTarget->Get('contact_id'), true, true /*allow all data*/);

		$oTargetAnswer = new SurveyTargetAnswer();
		$oTargetAnswer->Set('survey_id', $oTarget->Get('survey_id'));
		$sToken = $oTargetAnswer->SetToken();

		$oEvent = new SurveyNotification();
		$oEvent->Set('userinfo', UserRights::GetUser());
		$oEvent->Set('survey_id', $oTarget->Get('survey_id'));
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
			// Create the anonymous answer
			$oMyChange = MetaModel::NewObject("CMDBChange");
			$oMyChange->Set("date", time());
			$sUserString = CMDBChange::GetCurrentUserName();
			$oMyChange->Set("userinfo", $sUserString);
			$iChangeId = $oMyChange->DBInsert();
	
			$oTargetAnswer->DBInsertTracked($oMyChange);
		}

		// Keep track of the notification
		$oEvent->DBInsertNoReload();
	}

	/*
	* Send the quizz and make sure the email and form are localized according to the language of the survey/quizz
	* @param object $oContact Target recipient
	* @param string $sToken Optional token; if omitted then the email and forms will be in preview mode		
	*/
	protected function SendQuizzToContactLocalized($oContact, $sToken = null)
	{
		$oQuizz = MetaModel::GetObject('Quizz', $this->Get('quizz_id'), true, true /*allow all data*/);
		$oQuizz->ChangeDictionnaryLanguage();		
		try
		{
			$this->SendQuizzToContact($oQuizz, $oContact, $sToken);
		}
		catch(Exception $e)
		{
			$oQuizz->RestoreDictionnaryLanguage();
			throw $e;		
		}
		$oQuizz->RestoreDictionnaryLanguage();
	}

	/*
	 * Prepare the email and send it
	 * @param object $oQuizz The quizz
	 * @param object $oContact The target contact
	 * @param string $sToken The token identifying the recipient for the anonymous answer ; if omitted, this is a sample email
	 * @return void
	 */
	protected function SendQuizzToContact($oQuizz, $oContact, $sToken = null)
	{
		$oEmail = new EMail();

		$sQuizzUrl = $oQuizz->MakeFormUrl($sToken);

		$sBody = $this->Get('email_body');
		$sBody .= '<br/><a href="'.$sQuizzUrl.'">'.Dict::S('Survey-notif-linktoquizz').'</a>';

		if ($sToken)
		{
			$oEmail->SetSubject($this->Get('email_subject'));
		}
		else
		{
			$oEmail->SetSubject('['.Dict::S('Survey-email-preview').'] '.$this->Get('email_subject'));
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


	/*
	 * In state running, detect new target contacts and align them to already existing contacts
	 * @return void
	 */
	protected function OnUpdate()
	{
		if ($this->Get('status') == 'running')
		{
			// Detect new users and send them a notification
			$oOriginalTargetSet = $this->GetTargetsFromDB();
			$aOriginalSet = $oOriginalTargetSet->ToArray();
			 
			$oNewTargetSet = $this->Get('survey_target_list');
			$aNewSet = $oNewTargetSet->ToArray();

			foreach($aNewSet as $iId => $oTarget)
			{
				if (!array_key_exists($iId, $aOriginalSet))
				{
					$this->SendQuizzToTarget($oTarget);
				}
			}			
		}
	}


	/*
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
				$oTargetSet = $this->Get('survey_target_answer_list');
				$iAwaited = 0;
				while($oTarget = $oTargetSet->Fetch())
				{
					if (strlen($oTarget->Get('date_response')) == 0)
					{
						$iAwaited++;
					}
				}

				$iTargetCount = $oTargetSet->Count();
				$iAnswerCount = $iTargetCount - $iAwaited;
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

				$aQueries[Dict::S('Survey-query-comments')] = array(
					'oql' => 'SELECT SurveyTargetAnswer WHERE date_response AND survey_id = '.$this->GetKey(),
					'fields' => 'date_response,comment'
				);
				$aQueries[Dict::S('Survey-query-results')] = array(
					'oql' => 'SELECT SurveyAnswer AS A JOIN SurveyTargetAnswer AS T ON A.survey_target_id = T.id WHERE T.survey_id = '.$this->GetKey(),
					'fields' => 'question_title,question_description,value'
				);

				$oPage->add('<table>');
				foreach($aQueries AS $sLabel => $aData)
				{
					$oPage->add('<tr>');
					$oPage->add('<td>'.$sLabel.'</td>');

					$sQuery = urlencode($aData['oql']);
					$sAbsoluteUrl = utils::GetAbsoluteUrlAppRoot();

					$sRunQueryUrl = $sAbsoluteUrl.'webservices/export.php?login_mode=basic&format=HTML&expression='.$sQuery.'&fields='.$aData['fields'];
					$oPage->add('<td><a href="'.$sRunQueryUrl.'">'.Dict::S('Survey-results-excel').'</a></td>');

					$sRunQueryUrl = $sAbsoluteUrl.'webservices/export.php?format=CSV&expression='.$sQuery.'&fields='.$aData['fields'];
					$oPage->add('<td><a href="'.$sRunQueryUrl.'">'.Dict::S('Survey-results-csv').'</a></td>');

					$oPage->add('</tr>');
				}
				$oPage->add('</table>');

				$aValueAttDef = MetaModel::GetAttributeDef('SurveyAnswer', 'value');
				$aChoices = $aValueAttDef->GetAllowedValues(); // Array of value => label

				$oPage->add('<div class="survey-stats">');
				$oPage->add('<h1>'.Dict::S('Survey-results-statistics').'</h1>');
				if ($iAnswerCount > 0)
				{
					$oQuestionSearch = DBObjectSearch::FromOQL_AllData('SELECT QuizzQuestion AS Q JOIN SurveyAnswer AS A ON A.question_id = Q.id JOIN SurveyTargetAnswer AS T ON A.survey_target_id = T.id WHERE T.survey_id = '.$this->GetKey());
					$oQuestionSet = new DBObjectSet($oQuestionSearch);
					while ($oQuestion = $oQuestionSet->Fetch())
					{
						$oPage->add('<div>');
						$oPage->add('<h2>'.$oQuestion->GetName().'</h2>');

						$aResults = array();
						foreach($aChoices as $value => $sLabel)
						{
							$aResults[$value] = 0;
						}
	
						$oAnswerSearch = DBObjectSearch::FromOQL_AllData('SELECT SurveyAnswer AS A JOIN SurveyTargetAnswer AS T ON A.survey_target_id = T.id WHERE A.question_id = '.$oQuestion->GetKey().' AND T.survey_id = '.$this->GetKey());
						$oAnswerSet = new DBObjectSet($oAnswerSearch);
						while ($oAnswer = $oAnswerSet->Fetch())
						{
							$aResults[$oAnswer->Get('value')] += 1;
						}

						$oPage->add('<table>');
						foreach($aChoices as $value => $sLabel)
						{
							$iPercent = round(100 * $aResults[$value] / $iTargetCount);
							$iWidth = 200 * $iPercent / 100; // 200 px = 100 %
							$oPage->add('<tr>');
							$oPage->add('<td>'.$sLabel.'</td><td><div style="width:'.$iWidth.'px; display: inline-block; background: #1C94C4">&nbsp;</div>&nbsp;'.$iPercent.' %</td>');
							$oPage->add('</tr>');
						}
						$oPage->add('</table>');
						
	
						$oPage->add('</div>');
					}
					$oPage->add('</div>');
					$oPage->add('<div class="survey-comments">');
					$oPage->add('<h1>'.Dict::S('Survey-results-comments').'</h1>');
					$oCommentSearch = DBObjectSearch::FromOQL_AllData('SELECT SurveyTargetAnswer AS T WHERE T.comment != "" AND T.survey_id = '.$this->GetKey());
					$oCommentSet = new DBObjectSet($oCommentSearch);
					if ($oCommentSet->Count() > 0)
					{
						//$sOpenQuote = '<div class="quizzquote"><span class="bigquotes">&#171</span>';
						$sOpenQuote = '<div class="quizzquote" style="margin:5px; padding:5px; border-style:solid; border-width:thin; border-color:#696969; background-color:#DDDDDD;">';
						//$sCloseQuote = '<span class="bigquotes">&#187</span></div>';
						$sCloseQuote = '</div>';
						$oPage->add('<div>');
						while ($oComment = $oCommentSet->Fetch())
						{
							$oPage->add($sOpenQuote.trim($oComment->GetAsHtml('comment')).$sCloseQuote);
						}
						$oPage->add('</div>');
					}
					else
					{
						$oPage->p(Dict::S('Survey-results-nocomment'));
					}
				}
				else
				{
					$oPage->p(Dict::S('Survey-results-noanswer'));
				}
				$oPage->add('</div>');
			}		
		}
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
			"category" => "searchable,survey",
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
			"category" => "searchable,survey",
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
		MetaModel::Init_AddAttribute(new AttributeText("comment", array("allowed_values"=>null, "sql"=>"comment", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		//MetaModel::Init_AddAttribute(new AttributeLinkedSet("survey_answer_list", array("linked_class"=>"SurveyAnswer", "ext_key_to_me"=>"survey_target_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("contact_id", array("targetclass"=>"Contact", "jointype"=>null, "allowed_values"=>null, "sql"=>"contact_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));

		MetaModel::Init_AddAttribute(new AttributeExternalField("org_id", array("allowed_values"=>null, "extkey_attcode"=> 'contact_id', "target_attcode"=>"org_id")));

		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum('ongoing,finished'), "sql"=>"status", "default_value"=>"finished", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("nb_notifications_sent", array("allowed_values"=>null, "sql"=>"nb_notifications_sent", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("last_question_id", array("targetclass"=>"QuizzQuestion", "jointype"=>null, "allowed_values"=>null, "sql"=>"last_question_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		
		MetaModel::Init_SetZListItems('details', array('survey_id', 'date_response'));
		MetaModel::Init_SetZListItems('standard_search', array('survey_id', 'date_response'));
		MetaModel::Init_SetZListItems('list', array('survey_id', 'date_response'));
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
			"category" => "searchable,survey",
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
		//MetaModel::Init_AddAttribute(new AttributeInteger("value", array("allowed_values"=>null, "sql"=>"value", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("value", array("allowed_values"=>null, "sql"=>"value", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		
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
		// Add the admin menus
		if (UserRights::IsAdministrator()) // TODO: define who has the rights to view this menu and where it is positioned (Helpdesk ?)
		{
			if (false)
			{
			$oQuizzMenu = new MenuGroup('CustomerSurvey', 72 /* fRank */);
			}
			else
			{
			// #@# Do we have to maintain the exact same declaration (see user rights) ?!?!?!
			//$oMainMenu = new MenuGroup('DataAdministration', 70 /* fRank */, 'Organization', UR_ACTION_MODIFY, UR_ALLOWED_YES|UR_ALLOWED_DEPENDS);
			$oMainMenu = new MenuGroup('RequestManagement', 30 /* fRank */);
			$oQuizzMenu = new TemplateMenuNode('CustomerSurvey', '', $oMainMenu->GetIndex(), 50 /* fRank */);
			}
			$iIndex = 1;
			new OQLMenuNode('Quizzes', 'SELECT Quizz', $oQuizzMenu->GetIndex(), $iIndex++ /* fRank */);
			new OQLMenuNode('Surveys', 'SELECT Survey', $oQuizzMenu->GetIndex(), $iIndex++ /* fRank */);
		}
	}
}
// Declare a class that implements iBackgroundProcess (will be called by the CRON)
// Extend the class AsyncTask to create a queue of asynchronous tasks (process by the CRON)
// Declare a class that implements iApplicationUIExtension (to tune object display and edition form)
// Declare a class that implements iApplicationObjectExtension (to tune object read/write rules)

?>
