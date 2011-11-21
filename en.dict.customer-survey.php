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
	'Survey-Title-Draft' => 'iTop Customer Survey (draft)',

	'Menu:CustomerSurvey' => 'Customer surveys',
	'Menu:Quizzes' => 'Quizzes',
	'Menu:Quizzes+' => 'Quizzes',
	'Menu:Surveys' => 'Surveys',
	'Menu:Surveys+' => 'Surveys',

	'Survey-quizz-frame-definition' => 'Private definition',
	'Survey-quizz-frame-description' => 'Form header',

	'Survey-quizz-overview' => 'Preview',
	'Survey-quizz-shortcuttoquizz' => 'Click here to display the Quizz as a draft',
	'Survey-quizz-shortcutlabel' => 'quiz',

	'Survey-MandatoryQuestion' => 'This question is mandatory',
	'Survey-missing-answers' => 'Please, give an answer to all of the questions marked with an asterisk.',
	'Survey-tab-progress' => 'Progress',
	'Survey-awaited-answers' => 'Answers still awaited',
	'Survey-query-comments' => 'Comments (if any)',
	'Survey-query-results' => 'Answers',
	'Survey-results-excel' => 'For Excel',
	'Survey-results-csv' => 'As CSV',
	'Survey-results-statistics' => 'Statistics',
	'Survey-results-comments' => 'Comments',
	'Survey-results-nocomment' => 'No comment is available yet.',
	'Survey-results-noanswer' => 'No answer has been given yet.',

	'Survey-notif-linktoquizz' => 'Click here to start the Quizz',
	'Survey-form-alreadydone' => 'You have already answered (%1$s)',
	'Survey-form-closed' => 'Sorry, the survey has been closed',
	'Survey-form-comments' => 'Free comments and suggestions',
	'Survey-form-submit' => 'Record your answers',
	'Survey-form-done' => 'Your answers have been recorded.',
	'Survey-form-thankyou' => 'Thank you for your participation.',



	'Class:Quizz' => 'Quizz',
	'Class:Quizz+' => '',
	'Class:Quizz/Attribute:name' => 'Name',
	'Class:Quizz/Attribute:name+' => '',
	'Class:Quizz/Attribute:description' => 'Description',
	'Class:Quizz/Attribute:description+' => '',
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
	'Class:Survey/Stimulus:ev_start' => 'Start',
	'Class:Survey/Stimulus:ev_close' => 'Close',

	'Class:SurveyTarget' => 'Target contact',
	'Class:SurveyTarget+' => '',
	'Class:SurveyTarget/Attribute:survey_id' => 'Survey',
	'Class:SurveyTarget/Attribute:survey_id+' => '',
	'Class:SurveyTarget/Attribute:contact_id' => 'Contact',
	'Class:SurveyTarget/Attribute:contact_id+' => '',

	'Class:SurveyAnswer/Attribute:value/Value:0' => 'Very bad',
	'Class:SurveyAnswer/Attribute:value/Value:1' => 'Bad',
	'Class:SurveyAnswer/Attribute:value/Value:2' => 'Average',
	'Class:SurveyAnswer/Attribute:value/Value:3' => 'Good',
	'Class:SurveyAnswer/Attribute:value/Value:4' => 'Very good',

));

?>
