<?php
// Copyright (C) 2011 Combodo SARL
//

/**
 * Localized data
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */

Dict::Add('EN US', 'English', 'English', array(
	// Dictionary entries go here
	'Survey-Title' => 'iTop Customer Survey',
	'Survey-Title-Draft' => 'iTop Customer Survey (preview mode)',

	'Menu:CustomerSurvey' => 'Customer surveys',
	'Menu:Quizzes' => 'Quizzes',
	'Menu:Quizzes+' => 'Quizzes',
	'Menu:Surveys' => 'Surveys',
	'Menu:Surveys+' => 'Surveys',

	'Survey-quizz-overview' => 'Preview',
	'Survey-quizz-shortcuttoquizz' => 'Click here to preview the Quizz',
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

	'Survey-notif-linktoquizz' => 'Click here to start the Quizz',
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
	'Class:Quizz/Attribute:language' => 'Language',
	'Class:Quizz/Attribute:language+' => '',
	'Class:Quizz/Attribute:title' => 'Title',
	'Class:Quizz/Attribute:title+' => '',
	'Class:Quizz/Attribute:introduction' => 'Introduction',
	'Class:Quizz/Attribute:introduction+' => '',
	'Class:Quizz/Attribute:survey_list' => 'Surveys',
	'Class:Quizz/Attribute:survey_list+' => '',
	'Class:Quizz/Attribute:question_list' => 'Questions',
	'Class:Quizz/Attribute:question_list+' => '',

	'Class:QuizzQuestion' => 'Quizz question',
	'Class:QuizzQuestion+' => '',
	'Class:QuizzQuestion/Name' => '%1$s - %2$s',
	'Class:QuizzQuestion/Attribute:quizz_id' => 'Quizz',
	'Class:QuizzQuestion/Attribute:quizz_id+' => '',
	'Class:QuizzQuestion/Attribute:order' => 'Order',
	'Class:QuizzQuestion/Attribute:order+' => '',
	'Class:QuizzQuestion/Attribute:title' => 'Title',
	'Class:QuizzQuestion/Attribute:title+' => '',
	'Class:QuizzQuestion/Attribute:description' => 'Description',
	'Class:QuizzQuestion/Attribute:description+' => '',
	'Class:QuizzQuestion/Attribute:mandatory' => 'Mandatory',
	'Class:QuizzQuestion/Attribute:mandatory+' => '',
	
	'Class:Survey' => 'Survey',
	'Class:Survey+' => '',
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
	'Class:Survey/Attribute:survey_target_list' => 'Target contacts',
	'Class:Survey/Attribute:survey_target_list+' => '',
	'Class:Survey/Stimulus:ev_start' => 'Start the Survey',
	'Class:Survey/Stimulus:ev_close' => 'Terminate the Survey',
	'Class:Survey/Stimulus:ev_test' => 'Send me a sample message',

	'Class:SurveyTarget' => 'Target contact',
	'Class:SurveyTarget+' => '',
	'Class:SurveyTarget/Attribute:survey_id' => 'Survey',
	'Class:SurveyTarget/Attribute:survey_id+' => '',
	'Class:SurveyTarget/Attribute:contact_id' => 'Contact',
	'Class:SurveyTarget/Attribute:contact_id+' => '',

	'Class:SurveyNotification' => 'Survey Email',
	'Class:SurveyNotification+' => 'Survey Email',
	'Class:SurveyNotification/Attribute:survey_id' => 'Survey',
	'Class:SurveyNotification/Attribute:survey_id+' => '',
	'Class:SurveyNotification/Attribute:contact_id' => 'Target contact',
	'Class:SurveyNotification/Attribute:contact_id+' => '',

	'Survey-results-filter-organization' => 'Organizations',
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

	'Survey-Preview Mode' => 'Preview mode',
	'Survey-SuspendButton' => 'Suspend',
	'Survey-CompletionNotificationSubject_name' => 'One more answer for the anonymous survey %1$s',
	'Survey-CompletionNotificationBody_url' => 'The anonymous survey: $1%s just got one more answer',
	'Survey-CompletionNotificationSubject_name_contact' => '%2$s just answered the survey %1$s',
	'Survey-CompletionNotificationBody_url_contact' => '%2$s completed the survey: $1%s',
	'Survey-SurveyFinished' => 'This survey is closed. Answers are no longer accepted.',
	'Survey-AnswerAlreadyCommitted' => 'Your answers to this survey have already been recorded and can no longer be modified. You can now safely close this window.',
	'Survey-DefaultTitle' => 'Survey',
	'Survey-SurveyCompleted-Title' => 'Survey Completed',
	'Survey-SurveyCompleted-Default-Text' => 'Thank you for completing this survey. Your answers have been recorded. You can now safely close this window.',
	'Survey-suspend-confirmation-title' => 'Answers saved...',
	'Survey-suspend-confirmation-message_hyperlink' => '<p>Your answers have been saved, but the survey is not complete. You can close your browser and come back later to complete the survey using this link:</p><p>%1$s</p>',
	'Survey-exit-confirmation-message' => 'Are you sure you want to leave the page? (Your answers will NOT be saved)',

	'Survey-quizz-frame-definition' => 'Survey Definition (non-public)',
	'Survey-quizz-frame-description' => 'First Page',
	'Survey-quizz-last-page' => 'Closing Page',
));
