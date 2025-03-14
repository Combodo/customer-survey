<?php
/**
 * Localized data
 *
 * @copyright Copyright (C) 2010-2018 Combodo SARL
 * @license	http://opensource.org/licenses/AGPL-3.0
 *
 * This file is part of iTop.
 *
 * iTop is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * iTop is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with iTop. If not, see <http://www.gnu.org/licenses/>
 */

Dict::Add('EN GB', 'British English', 'British English', array(
	// Dictionary entries go here
	'Survey-Title' => 'iTop Customer Survey',
	'Survey-Title-Draft' => 'iTop Customer Survey (preview mode)',

	'Menu:CustomerSurvey' => 'Customer surveys',
	'Menu:Quizzes' => 'Quizzes',
	'Menu:Quizzes+' => 'Quizzes',
	'Menu:Surveys' => 'Surveys',
	'Menu:Surveys+' => 'Surveys',

	'Survey-quizz-overview' => 'Preview',
	'Survey-quizz-shortcuttoquizz' => 'Click here to preview the Quiz',
	'Survey-quizz-shortcutlabel' => 'quizz',

	'Survey-MandatoryQuestion' => 'This question is mandatory',
	'Survey-missing-answers' => 'Please, give an answer to all of the questions marked with an asterisk.',
	'Survey-tab-progress' => 'Progress',
	'Survey-awaited-answers' => 'Answers still awaited',
	'Survey-progress-status' => 'Progress by target',
	'Survey-progress-notifications' => 'Notifications sent so far',

	'Survey-With-Selected' => 'With selected...',
	'Survey-Resend-Button' => 'Send again...',
	'Survey-Resend-Title' => 'Send the survey again',
	'Survey-Resend-Ok' => 'Send!',
	'Survey-Resend-Cancel' => 'Cancel',

	'Survey-tab-results' => 'Results',

	'Survey-notif-linktoquizz' => 'Click here to start the Quiz',
	'Survey-form-alreadydone' => 'You have already answered (%1$s)',
	'Survey-form-closed' => 'Sorry, the survey has been closed',
	'Survey-form-comments' => 'Free comments and suggestions',
	'Survey-form-submit' => 'Record your answers',
	'Survey-form-done' => 'Your answers have been recorded.',
	'Survey-form-thankyou' => 'Thank you for your participation.',

	'Survey-email-preview' => 'Preview',
	'Survey-email-notsent' => 'Failed to send the email:',
	'Survey-email-ok' => 'Email sent',

	'Class:Quizz' => 'Quizz',
	'Class:Quizz+' => '',
	'Class:Quizz/Attribute:name' => 'Name',
	'Class:Quizz/Attribute:name+' => '',
	'Class:Quizz/Attribute:description' => 'Description',
	'Class:Quizz/Attribute:description+' => '',
	'Class:Quizz/Attribute:language' => 'Quizz Language',
	'Class:Quizz/Attribute:language+' => '',
	'Class:Quizz/Attribute:title' => 'Title',
	'Class:Quizz/Attribute:title+' => '',
	'Class:Quizz/Attribute:introduction' => 'Introduction',
	'Class:Quizz/Attribute:introduction+' => '',
	'Class:Quizz/Attribute:scale_values' => 'Default Quiz Choices',
	'Class:Quizz/Attribute:conclusion?' => 'Comma separated list of values',
	'Class:Quizz/Attribute:conclusion' => 'Conclusion message',
	'Class:Quizz/Attribute:conclusion+' => 'Message displayed on the last page of the quiz',
	'Class:Quizz/Attribute:survey_list' => 'Surveys',
	'Class:Quizz/Attribute:survey_list+' => 'Surveys based on this quiz',
	'Class:Quizz/Attribute:question_list' => 'Questions',
	'Class:Quizz/Attribute:question_list+' => '',

	'Class:QuizzElement' => 'Quizz element',
	'Class:QuizzElement+' => '',
	'Class:QuizzElement/Name' => '%1$s - %2$s',
	'Class:QuizzElement/Attribute:quizz_id' => 'Quizz',
	'Class:QuizzElement/Attribute:quizz_id+' => '',
	'Class:QuizzElement/Attribute:order' => 'Order',
	'Class:QuizzElement/Attribute:order+' => '',
	'Class:QuizzElement/Attribute:title' => 'Title',
	'Class:QuizzElement/Attribute:title+' => '',
	'Class:QuizzElement/Attribute:description' => 'Description',
	'Class:QuizzElement/Attribute:description+' => '',
	'Class:QuizzElement/Attribute:mandatory' => 'Mandatory',
	'Class:QuizzElement/Attribute:mandatory+' => '',
	'Class:QuizzElement/Attribute:finalclass' => 'Question Type',

	'Class:QuizzValueQuestion' => 'Specific choices question',
	'Class:QuizzValueQuestion+' => 'Pick one choice among a list of values (specific for this question)',
	'Class:QuizzValueQuestion/Name' => '%1$s) %2$s',
	'Class:QuizzValueQuestion/Attribute:choices' => 'Choices (comma separated list)',

	'Class:QuizzScaleQuestion' => 'Predefined choices question',
	'Class:QuizzScaleQuestion+' => 'Pick one choice among a list of values (predefined for the whole quiz)',
	'Class:QuizzScaleQuestion/Name' => '%1$s) %2$s',

	'Class:QuizzFreeTextQuestion' => 'Free question',
	'Class:QuizzFreeTextQuestion+' => 'Free text field',
	'Class:QuizzFreeTextQuestion/Name' => '%1$s) %2$s',

	'Class:QuizzNewPageElement' => 'Page break in quiz',
	'Class:QuizzNewPageElement+' => 'Start a new page for the quiz',
	'Class:QuizzNewPageElement/Name' => '%1$s) %2$s',

	'Class:Survey' => 'Survey',
	'Class:Survey+' => '',
	'Class:Survey/Name' => '%1$s / %2$s',
	'Class:Survey/Attribute:quizz_id' => 'Quizz',
	'Class:Survey/Attribute:quizz_id+' => '',
	'Class:Survey/Attribute:status' => 'Status',
	'Class:Survey/Attribute:status+' => '',
	'Class:Survey/Attribute:status/Value:new' => 'New',
	'Class:Survey/Attribute:status/Value:running' => 'Ongoing',
	'Class:Survey/Attribute:status/Value:closed' => 'Closed',
	'Class:Survey/Attribute:date_sent' => 'Sent',
	'Class:Survey/Attribute:date_sent+' => '',
	'Class:Survey/Attribute:on_behalf_of' => 'On behalf of',
	'Class:Survey/Attribute:on_behalf_of+' => '',
	'Class:Survey/Attribute:language' => 'Language',
	'Class:Survey/Attribute:language+' => '',
	'Class:Survey/Attribute:email_subject' => 'Email subject',
	'Class:Survey/Attribute:email_subject+' => '',
	'Class:Survey/Attribute:email_body' => 'Email body (html)',
	'Class:Survey/Attribute:email_body+' => '',
	'Class:Survey/Attribute:survey_target_list' => 'Additional Recipients',
	'Class:Survey/Attribute:survey_target_list+' => '',
	'Class:Survey/Stimulus:ev_start' => 'Start the Survey',
	'Class:Survey/Stimulus:ev_close' => 'Terminate the Survey',
	'Class:Survey/Stimulus:ev_test' => 'Send me a sample message',
	'Class:Survey/Attribute:email_on_completion' => 'Email on completion',
	'Class:Survey/Attribute:email_on_completion?' => 'Send an email to the emitter of the survey when someone completes the survey.',
	'Class:Survey/Attribute:target_phrase_id' => 'Recipients of the Survey',
	'Class:Survey/Attribute:target_phrase_id?' => 'Define the recipients of the survey based on a query stored in the Phrasebook',

	'Class:SurveyTarget' => 'Surveyed contact',
	'Class:SurveyTarget+' => '',
	'Class:SurveyTarget/Attribute:survey_id' => 'Survey',
	'Class:SurveyTarget/Attribute:survey_id+' => '',
	'Class:SurveyTarget/Attribute:contact_id' => 'Contact',
	'Class:SurveyTarget/Attribute:contact_id+' => '',
	'Class:SurveyTargetAnswer' => 'Survey Target Answer',
	'Class:SurveyTargetAnswer+' => '',
	'Class:SurveyTargetAnswer/Attribute:contact_id' => 'Recipient',
	'Class:SurveyTargetAnswer/Attribute:contact_name' => 'Recipient',
	'Class:SurveyTargetAnswer/Attribute:org_id' => 'Recipient Organisation',
	'Class:SurveyTargetAnswer/Attribute:org_name' => 'Recipient Organisation',
	'Class:SurveyTargetAnswer/Attribute:nb_notifications_sent' => 'Number of notifications',
	'Class:SurveyTargetAnswer/Attribute:status' => 'Status',
	'Class:SurveyTargetAnswer/Attribute:status/Value:ongoing' => 'On going',
	'Class:SurveyTargetAnswer/Attribute:status/Value:finished' => 'Finished',
	'Class:SurveyTargetAnswer/Attribute:date_response' => 'Answer date',
	'Class:SurveyTargetAnswer/Attribute:token' => 'Anonymisation Token',
	'Class:SurveyTargetAnswer/Attribute:survey_id' => 'Survey',
	'Class:SurveyTargetAnswer/Attribute:last_question_id' => 'Last question answered',

	'Class:SurveyNotification' => 'Survey Email',
	'Class:SurveyNotification+' => 'Survey Email',
	'Class:SurveyNotification/Attribute:survey_id' => 'Survey',
	'Class:SurveyNotification/Attribute:survey_id+' => '',
	'Class:SurveyNotification/Attribute:contact_id' => 'Target contact',
	'Class:SurveyNotification/Attribute:contact_id+' => '',

	'Survey-results-fitlering' => 'Filtering',
	'Survey-results-filter-organization' => 'Organisations',
	'Survey-results-filter-contact' => 'Contacts',
	'Survey-results-apply-filter' => 'Apply Filter',
	'Survey-query-results' => 'Export Raw Answers',
	'Survey-results-excel' => 'For Excel',
	'Survey-results-csv' => 'As CSV',
	'Survey-results-statistics' => 'Statistics',
	'Survey-results-statistics-filtered' => 'Statistics (filtered)',
	'Survey-results-noanswer' => 'No answer has been given yet.',
	'Survey-results-X_NonEmptyValuesOutOf_N' => '%1$d non empty answer(s) out of %2$d',
	'Survey-results-completion_X_out_of_Y_Percent' => '%1$d persons out of %2$d answered (%3$s %% completion)',
	'Survey-query-results-export' => 'Export',
	'Survey-results-print' => 'Printable version',

	'Survey-Title-Page_X_of_Y' => '%1$s, page %2$d of %3$d',
	'Survey-Preview Mode' => 'Preview mode',
	'Survey-FinishButton' => 'Finish',
	'Survey-NextButton' => 'Next >>',
	'Survey-SuspendButton' => 'Suspend',
	'Survey-CompletionNotificationSubject_name' => 'One more answer for the anonymous survey %1$s',
	'Survey-CompletionNotificationBody_url' => 'The anonymous survey: %1$s just got one more answer',
	'Survey-CompletionNotificationSubject_name_contact' => '%2$s just answered the survey %1$s',
	'Survey-CompletionNotificationBody_url_contact' => '%2$s completed the survey: %1$s',
	'Survey-SurveyFinished' => 'This survey is closed. Answers are no longer accepted.',
	'Survey-AnswerAlreadyCommitted' => 'Your answers to this survey have already been recorded and can no longer be modified. You can now safely close this window.',
	'Survey-DefaultTitle' => 'Survey',
	'Survey-SurveyCompleted-Title' => 'Survey Completed',
	'Survey-SurveyCompleted-Default-Text' => 'Thank you for completing this survey. Your answers have been recorded. You can now safely close this window.',
	'Survey-suspend-confirmation-title' => 'Answers saved...',
	'Survey-suspend-confirmation-message_hyperlink' => '<p>Your answers have been saved, but the survey is not complete. You can close your browser and come back later to complete the survey using this link:</p><p>%1$s</p>',
	'Survey-exit-confirmation-message' => 'Are you sure you want to leave the page? (Your answers will NOT be saved)',

	'Survey-quizz-frame-definition' => 'Survey Definition',
	'Survey-quizz-frame-description' => 'First Page',
	'Survey-quizz-last-page' => 'Closing Page',
));

//
// Class: SurveyAnswer
//

Dict::Add('EN GB', 'British English', 'British English', array(
	'Class:SurveyAnswer' => 'SurveyAnswer',
	'Class:SurveyAnswer+' => '',
	'Class:SurveyAnswer/Attribute:survey_target_id' => 'Survey target id',
	'Class:SurveyAnswer/Attribute:survey_target_id+' => '',
	'Class:SurveyAnswer/Attribute:question_id' => 'Question id',
	'Class:SurveyAnswer/Attribute:question_id+' => '',
	'Class:SurveyAnswer/Attribute:question_title' => 'Question title',
	'Class:SurveyAnswer/Attribute:question_title+' => '',
	'Class:SurveyAnswer/Attribute:question_description' => 'Question description',
	'Class:SurveyAnswer/Attribute:question_description+' => '',
	'Class:SurveyAnswer/Attribute:contact_id' => 'Contact id',
	'Class:SurveyAnswer/Attribute:contact_id+' => '',
	'Class:SurveyAnswer/Attribute:contact_name' => 'Contact name',
	'Class:SurveyAnswer/Attribute:contact_name+' => '',
	'Class:SurveyAnswer/Attribute:org_id' => 'Org id',
	'Class:SurveyAnswer/Attribute:org_id+' => '',
	'Class:SurveyAnswer/Attribute:org_name' => 'Org name',
	'Class:SurveyAnswer/Attribute:org_name+' => '',
	'Class:SurveyAnswer/Attribute:value' => 'Value',
	'Class:SurveyAnswer/Attribute:value+' => '',
	'Class:SurveyAnswer/Attribute:question_id_finalclass_recall' => 'Question id finalclass recall',
	'Class:SurveyAnswer/Attribute:question_id_finalclass_recall+' => '',
	'Class:SurveyAnswer/Attribute:contact_id_obsolescence_flag' => 'Contact id obsolescence flag',
	'Class:SurveyAnswer/Attribute:contact_id_obsolescence_flag+' => '',
	'Class:SurveyAnswer/Attribute:org_id_obsolescence_flag' => 'Org id obsolescence flag',
	'Class:SurveyAnswer/Attribute:org_id_obsolescence_flag+' => '',
));

//
// Class: Quizz
//

Dict::Add('EN GB', 'British English', 'British English', array(
	'Class:Quizz/Attribute:language/Value:Brazilian (Brazilian)' => 'Brazilian (Brazilian)',
	'Class:Quizz/Attribute:language/Value:Brazilian (Brazilian)+' => '',
	'Class:Quizz/Attribute:language/Value:Hungarian (Magyar)' => 'Hungarian (Magyar)',
	'Class:Quizz/Attribute:language/Value:Hungarian (Magyar)+' => '',
	'Class:Quizz/Attribute:language/Value:Chinese (简体中文)' => 'Chinese (简体中文)',
	'Class:Quizz/Attribute:language/Value:Chinese (简体中文)+' => '',
	'Class:Quizz/Attribute:language/Value:Dutch (Nederlands)' => 'Dutch (Nederlands)',
	'Class:Quizz/Attribute:language/Value:Dutch (Nederlands)+' => '',
	'Class:Quizz/Attribute:language/Value:English (English)' => 'English (English)',
	'Class:Quizz/Attribute:language/Value:English (English)+' => '',
	'Class:Quizz/Attribute:language/Value:German (Deutsch)' => 'German (Deutsch)',
	'Class:Quizz/Attribute:language/Value:German (Deutsch)+' => '',
	'Class:Quizz/Attribute:language/Value:Russian (Русский)' => 'Russian (Русский)',
	'Class:Quizz/Attribute:language/Value:Russian (Русский)+' => '',
	'Class:Quizz/Attribute:language/Value:Spanish (Español, Castellaño)' => 'Spanish (Español, Castellano)',
	'Class:Quizz/Attribute:language/Value:Spanish (Español, Castellaño)+' => '',
	'Class:Quizz/Attribute:language/Value:French (Français)' => 'French (Français)',
	'Class:Quizz/Attribute:language/Value:French (Français)+' => '',
	'Class:Quizz/Attribute:language/Value:Japanese (日本語)' => 'Japanese (日本語)',
	'Class:Quizz/Attribute:language/Value:Japanese (日本語)+' => '',
	'Class:Quizz/Attribute:language/Value:Turkish (Türkçe)' => 'Turkish (Türkçe)',
	'Class:Quizz/Attribute:language/Value:Turkish (Türkçe)+' => '',
	'Class:Quizz/Attribute:language/Value:Danish (Dansk)' => 'Danish (Dansk)',
	'Class:Quizz/Attribute:language/Value:Danish (Dansk)+' => '',
	'Class:Quizz/Attribute:language/Value:Czech (Čeština)' => 'Czech (Čeština)',
	'Class:Quizz/Attribute:language/Value:Czech (Čeština)+' => '',
	'Class:Quizz/Attribute:language/Value:Italian (Italiano)' => 'Italian (Italiano)',
	'Class:Quizz/Attribute:language/Value:Italian (Italiano)+' => '',
));

//
// Class: QuizzElement
//

Dict::Add('EN GB', 'British English', 'British English', array(
	'Class:QuizzElement/Attribute:mandatory/Value:yes' => 'Yes',
	'Class:QuizzElement/Attribute:mandatory/Value:yes+' => '',
	'Class:QuizzElement/Attribute:mandatory/Value:no' => 'No',
	'Class:QuizzElement/Attribute:mandatory/Value:no+' => '',
));

//
// Class: QuizzScaleQuestion
//

Dict::Add('EN GB', 'British English', 'British English', array(
	'Class:QuizzScaleQuestion/Attribute:scale_values' => 'Scale values',
	'Class:QuizzScaleQuestion/Attribute:scale_values+' => '',
));

//
// Class: Survey
//

Dict::Add('EN GB', 'British English', 'British English', array(
	'Class:Survey/Attribute:email_on_completion/Value:yes' => 'Yes',
	'Class:Survey/Attribute:email_on_completion/Value:yes+' => '',
	'Class:Survey/Attribute:email_on_completion/Value:no' => 'No',
	'Class:Survey/Attribute:email_on_completion/Value:no+' => '',
	'Class:Survey/Attribute:survey_target_answer_list' => 'Survey target answer list',
	'Class:Survey/Attribute:survey_target_answer_list+' => '',
	'Class:Survey/Attribute:on_behalf_of_finalclass_recall' => 'On behalf of finalclass recall',
	'Class:Survey/Attribute:on_behalf_of_finalclass_recall+' => '',
	'Class:Survey/Attribute:on_behalf_of_obsolescence_flag' => 'On behalf of obsolescence flag',
	'Class:Survey/Attribute:on_behalf_of_obsolescence_flag+' => '',
));

//
// Class: SurveyTarget
//

Dict::Add('EN GB', 'British English', 'British English', array(
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall' => 'Contact id finalclass recall',
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall+' => '',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag' => 'Contact id obsolescence flag',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag+' => '',
));

//
// Class: SurveyTargetAnswer
//

Dict::Add('EN GB', 'British English', 'British English', array(
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall' => 'Contact id finalclass recall',
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall+' => '',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag' => 'Contact id obsolescence flag',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag+' => '',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag' => 'Org id obsolescence flag',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag+' => '',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall' => 'Last question id finalclass recall',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall+' => '',
));
