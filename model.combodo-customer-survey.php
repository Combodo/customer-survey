<?php
// Copyright (C) 2011 Combodo SARL
//

/**
 * Module combodo-customer-survey
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */

// Add class definitions here
/**
 * Defines a quiz used to generate a survey
 */
class Quiz extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "searchable,survey",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "quiz",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		
		MetaModel::Init_AddAttribute(new AttributeString("title", array("allowed_values"=>null, "sql"=>"title", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("introduction", array("allowed_values"=>null, "sql"=>"introduction", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("min_value", array("allowed_values"=>null, "sql"=>"min_value", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("min_label", array("allowed_values"=>null, "sql"=>"min_label", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("max_value", array("allowed_values"=>null, "sql"=>"max_value", "default_value"=>10, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("max_label", array("allowed_values"=>null, "sql"=>"max_label", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("above_labels", array("allowed_values"=>null, "sql"=>"above_labels", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("comments", array("allowed_values"=>new ValueSetEnum('yes,no'), "sql"=>"comments", "default_value"=>"yes", "is_null_allowed"=>false, "depends_on"=>array())));

		MetaModel::Init_AddAttribute(new AttributeText("default_message", array("allowed_values"=>null, "sql"=>"default_message", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array(
				'col:0'=> array('fieldset:Quiz Definition' => array('name','description'),'comments','fieldset:Quiz Answers' => array('min_value','min_label','max_value','max_label','above_labels')),
				'col:1'=> array('fieldset:User Description' => array('title','introduction'),'default_message')
		));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'description', 'title', 'introduction'));
		MetaModel::Init_SetZListItems('list', array('name', 'description'));
	}
}

/**
 * A simple question inside a quiz
 */
class Question extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "searchable,survey",
			"key_type" => "autoincrement",
			"name_attcode" => array("quiz_id_friendlyname", "order"),
			"state_attcode" => "",
			"reconc_keys" => array("quiz_id_friendlyname", "order"),
			"db_table" => "question",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("quiz_id", array("targetclass"=>"Quiz", "jointype"=>null, "allowed_values"=>null, "sql"=>"quiz_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("order", array("allowed_values"=>null, "sql"=>"order", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("title", array("allowed_values"=>null, "sql"=>"title", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("mandatory", array("allowed_values"=>new ValueSetEnum('yes,no'), "sql"=>"mandatory", "default_value"=>"yes", "is_null_allowed"=>false, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('quiz_id', 'order', 'title', 'description', 'mandatory'));
		MetaModel::Init_SetZListItems('standard_search', array('quiz_id', 'order', 'title', 'description', 'mandatory'));
		MetaModel::Init_SetZListItems('list', array('quiz_id', 'order', 'title', 'mandatory'));
	}
}

		
/**
 * Survey: an instanciation of a quiz for a given set of persons
 */
class Survey extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "searchable,survey",
			"key_type" => "autoincrement",
			"name_attcode" => array("quiz_id_friendlyname", "date_sent"),
			"state_attcode" => "",
			"reconc_keys" => array("quiz_id_friendlyname", "date_sent"),
			"db_table" => "question",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("quiz_id", array("targetclass"=>"Quiz", "jointype"=>null, "allowed_values"=>null, "sql"=>"quiz_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDateTime("date_sent", array("allowed_values"=>null, "sql"=>"date_sent", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("user_id", array("targetclass"=>"User", "jointype"=>null, "allowed_values"=>null, "sql"=>"user_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('quiz_id', 'date_sent', 'user_id'));
		MetaModel::Init_SetZListItems('standard_search', array('quiz_id', 'date_sent', 'user_id'));
		MetaModel::Init_SetZListItems('list', array('quiz_id', 'date_sent', 'user_id'));
	}
}

/**
 * SurveyTarget: an anonymous target of a survey
 */
class SurveyTarget extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "searchable,survey",
			"key_type" => "autoincrement",
			"name_attcode" => array("survey_id_friendlyname", "token"),
			"state_attcode" => "",
			"reconc_keys" => array("survey_id_friendlyname", "token"),
			"db_table" => "question",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("survey_id", array("targetclass"=>"Survey", "jointype"=>null, "allowed_values"=>null, "sql"=>"survey_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("token", array("allowed_values"=>null, "sql"=>"token", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDateTime("date_response", array("allowed_values"=>null, "sql"=>"date_response", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("comment", array("allowed_values"=>null, "sql"=>"comment", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('survey_id', 'token', 'date_response', 'comment'));
		MetaModel::Init_SetZListItems('standard_search', array('survey_id', 'token', 'date_response', 'comment'));
		MetaModel::Init_SetZListItems('list', array('survey_id', 'token', 'date_response'));
	}
}

/**
 * SurveyAnswer: the answer of one target to a given question of a survey
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
			"db_table" => "question",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("survey_target_id", array("targetclass"=>"SurveyTarget", "jointype"=>null, "allowed_values"=>null, "sql"=>"survey_target_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("question_id", array("targetclass"=>"Question", "jointype"=>null, "allowed_values"=>null, "sql"=>"question_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("value", array("allowed_values"=>null, "sql"=>"value", "default_value"=>0, "is_null_allowed"=>false, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('survey_target_id', 'question_id', 'value'));
		MetaModel::Init_SetZListItems('standard_search', array('survey_target_id', 'question_id', 'value'));
		MetaModel::Init_SetZListItems('list', array('survey_target_id', 'question_id', 'value'));
	}
}

// Add menus creation here
class CombodoSurvey extends ModuleHandlerAPI
{
	public static function OnMenuCreation()
	{
		// Add the admin menus
		if (UserRights::IsAdministrator()) // TODO: define who has the rights to view this menu and where it is positioned (Helpdesk ?)
		{
			$oQuizMenu = new MenuGroup('CustomerSurvey', 72 /* fRank */);
			$iIndex = 1;
			new OQLMenuNode('Quizzes', 'SELECT Quiz', $oQuizMenu->GetIndex(), $iIndex++ /* fRank */);
		}
	}
}
// Declare a class that implements iBackgroundProcess (will be called by the CRON)
// Extend the class AsyncTask to create a queue of asynchronous tasks (process by the CRON)
// Declare a class that implements iApplicationUIExtension (to tune object display and edition form)
// Declare a class that implements iApplicationObjectExtension (to tune object read/write rules)

?>
