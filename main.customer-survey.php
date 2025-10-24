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
 * Log of notifications sent to target contacts
 *
 */
class SurveyNotification extends Event
{
	public static function Init()
	{
		$aParams =
		[
			"category" => "core/cmdb,view_in_gui",
			"key_type" => "autoincrement",
			"name_attcode" => "",
			"state_attcode" => "",
			"reconc_keys" => [],
			"db_table" => "qz_event_notification",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
			'order_by_default' => ['date' => false],
		];
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("survey_id", ["targetclass" => "Survey", "jointype" => "", "allowed_values" => null, "sql" => "survey_id", "is_null_allowed" => false, "on_target_delete" => DEL_AUTO, "depends_on" => []]));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("contact_id", ["targetclass" => "Contact", "jointype" => "", "allowed_values" => null, "sql" => "contact_id", "is_null_allowed" => false, "on_target_delete" => DEL_AUTO, "depends_on" => []]));

		// Display lists
		MetaModel::Init_SetZListItems('details', ['survey_id', 'userinfo', 'contact_id', 'date', 'message']); // Attributes to be displayed for the complete details
		MetaModel::Init_SetZListItems('list', ['contact_id', 'date', 'message']); // Attributes to be displayed for a list
	}
}
