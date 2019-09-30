<?php
// Copyright (C) 2011 Combodo SARL
//
/**
 * Localized data
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @author		 Robert Jaehne <robert.jaehne@itomig.de>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */
Dict::Add('DE DE', 'German', 'Deutsch', array(
	// Dictionary entries go here
	'Survey-Title' => 'iTop Kundenbefragung',
	'Survey-Title-Draft' => 'iTop Kundenbefragung (Vorschau)',

	'Menu:CustomerSurvey' => 'Kundenbefragungen',
	'Menu:Quizzes' => 'Umfragen',
	'Menu:Quizzes+' => 'Umfragen',
	'Menu:Surveys' => 'Befragung',
	'Menu:Surveys+' => 'Befragung',

	'Survey-quizz-overview' => 'Vorschau',
	'Survey-quizz-shortcuttoquizz' => 'Hier klicken, für eine Vorschau auf die Umfrage.',
	'Survey-quizz-shortcutlabel' => 'Umfrage',

	'Survey-MandatoryQuestion' => 'Diese Frage muss beantwortet werden',
	'Survey-missing-answers' => 'Bitte beantworten sie alle Fragen, die mit einem Sternchen markiert sind.',
	'Survey-tab-progress' => 'Fortschritt',
	'Survey-awaited-answers' => 'Antworten werden erwartet',
	'Survey-progress-status' => 'Fortschritt je Ziel',
	'Survey-progress-notifications' => 'Bisher versandte Benachrichtigungen',

	'Survey-With-Selected' => 'Mit ausgewählten ...',
	'Survey-Resend-Button' => 'Nochmal senden ...',
	'Survey-Resend-Title' => 'Die Umfrage noch einmal versenden',
	'Survey-Resend-Ok' => 'Senden!',
	'Survey-Resend-Cancel' => 'Abbrechen',

	'Survey-tab-results' => 'Ergebnisse',

	'Survey-notif-linktoquizz' => 'Hier klicken um die Umfrage zu starten',
	'Survey-form-alreadydone' => 'Sie haben (%1$s) bereits beantwortet',
	'Survey-form-closed' => 'Die Umfrage wurde abgeschlossen',
	'Survey-form-comments' => 'Kommentare und Anregungen',
	'Survey-form-submit' => 'Antworten speichern',
	'Survey-form-done' => 'Ihre Antworten wurden gespeichert.',
	'Survey-form-thankyou' => 'Danke für ihre Teilnahme!',

	'Survey-email-preview' => 'Vorschau',
	'Survey-email-notsent' => 'EMail konnte nicht gesendet werden:',
	'Survey-email-ok' => 'EMail gesendet',

	'Class:Quizz' => 'Umfrage',
	'Class:Quizz+' => '',
	'Class:Quizz/Attribute:name' => 'Name',
	'Class:Quizz/Attribute:name+' => '',
	'Class:Quizz/Attribute:description' => 'Beschreibung',
	'Class:Quizz/Attribute:description+' => '',
	'Class:Quizz/Attribute:language' => 'Umfragesprache',
	'Class:Quizz/Attribute:language+' => '',
	'Class:Quizz/Attribute:title' => 'Titel',
	'Class:Quizz/Attribute:title+' => '',
	'Class:Quizz/Attribute:introduction' => 'Einleitung',
	'Class:Quizz/Attribute:introduction+' => '',
	'Class:Quizz/Attribute:scale_values' => 'Default Umfrageantwort',
	'Class:Quizz/Attribute:conclusion?' => 'Komma separierte Liste von Werten',
	'Class:Quizz/Attribute:conclusion' => 'Abschliessende Information',
	'Class:Quizz/Attribute:conclusion+' => 'Information, die auf der letzten Seite der Umfrage angezeigt wird.',
	'Class:Quizz/Attribute:survey_list' => 'Befragung',
	'Class:Quizz/Attribute:survey_list+' => 'Befragungen, die auf dieser Umfrage basieren',
	'Class:Quizz/Attribute:question_list' => 'Fragen',
	'Class:Quizz/Attribute:question_list+' => '',

	'Class:QuizzElement' => 'Umfrageelement',
	'Class:QuizzElement+' => '',
	'Class:QuizzElement/Name' => '%1$s - %2$s',
	'Class:QuizzElement/Attribute:quizz_id' => 'Umfrage',
	'Class:QuizzElement/Attribute:quizz_id+' => '',
	'Class:QuizzElement/Attribute:order' => 'Sortierung',
	'Class:QuizzElement/Attribute:order+' => '',
	'Class:QuizzElement/Attribute:title' => 'Titel',
	'Class:QuizzElement/Attribute:title+' => '',
	'Class:QuizzElement/Attribute:description' => 'Beschreibung',
	'Class:QuizzElement/Attribute:description+' => '',
	'Class:QuizzElement/Attribute:mandatory' => 'Notwendig',
	'Class:QuizzElement/Attribute:mandatory+' => '',
	'Class:QuizzElement/Attribute:finalclass' => 'Typ der Frage',

	'Class:QuizzValueQuestion' => 'Spezifische Auswahl',
	'Class:QuizzValueQuestion+' => 'Auswahl einer Antwort aus einer Liste von Antworten (spezifisch für diese Frage)',
	'Class:QuizzScaleQuestion' => 'Vordefiniert Auswahl',
	'Class:QuizzScaleQuestion+' => 'Auswahl einer Antwort auch einer Liste von Werten (vordefiniert für die ganze Umfrage)',
	'Class:QuizzFreeTextQuestion' => 'Freitext',
	'Class:QuizzFreeTextQuestion+' => 'Freitextfeld',
	'Class:QuizzNewPageElement' => 'Seitenumbruch',
	'Class:QuizzNewPageElement+' => 'Startet eine neue Umfrageseite',

	'Class:QuizzValueQuestion/Attribute:choices' => 'Auswahlmöglichkeiten (Komma separierte Liste)',

	'Class:Survey' => 'Befragung',
	'Class:Survey+' => '',
	'Class:Survey/Attribute:quizz_id' => 'Umfrage',
	'Class:Survey/Attribute:quizz_id+' => '',
	'Class:Survey/Attribute:status' => 'Status',
	'Class:Survey/Attribute:status+' => '',
	'Class:Survey/Attribute:status/Value:new' => 'Neu',
	'Class:Survey/Attribute:status/Value:running' => 'Laufend',
	'Class:Survey/Attribute:status/Value:closed' => 'Abgeschlossen',
	'Class:Survey/Attribute:date_sent' => 'Gesendet',
	'Class:Survey/Attribute:date_sent+' => '',
	'Class:Survey/Attribute:on_behalf_of' => 'Im Namen von',
	'Class:Survey/Attribute:on_behalf_of+' => '',
	'Class:Survey/Attribute:language' => 'Sprache',
	'Class:Survey/Attribute:language+' => '',
	'Class:Survey/Attribute:email_subject' => 'Email Betreff',
	'Class:Survey/Attribute:email_subject+' => '',
	'Class:Survey/Attribute:email_body' => 'Email Body (html)',
	'Class:Survey/Attribute:email_body+' => '',
	'Class:Survey/Attribute:survey_target_list' => 'Weitere Empfänger',
	'Class:Survey/Attribute:survey_target_list+' => '',
	'Class:Survey/Stimulus:ev_start' => 'Starte die Befragung',
	'Class:Survey/Stimulus:ev_close' => 'Befragung abschliessen',
	'Class:Survey/Stimulus:ev_test' => 'Testnachricht an mich versenden',
	'Class:Survey/Attribute:email_on_completion' => 'Email bei Beendigung',
	'Class:Survey/Attribute:email_on_completion?' => 'EMail an den Herausgeber der Umfrage senden, wenn sie von jemandem abgeschlossen wurde.',
	'Class:Survey/Attribute:target_phrase_id' => 'Empfänger der Befragung',
	'Class:Survey/Attribute:target_phrase_id?' => 'Definition der Empfänger der Befragung, basierend auf einer Abfrage die im Phrasebook gespeichert ist.',

	'Class:SurveyTarget' => 'Zielkontakt',
	'Class:SurveyTarget+' => '',
	'Class:SurveyTarget/Attribute:survey_id' => 'Befragung',
	'Class:SurveyTarget/Attribute:survey_id+' => '',
	'Class:SurveyTarget/Attribute:contact_id' => 'Kontakt',
	'Class:SurveyTarget/Attribute:contact_id+' => '',

	'Class:SurveyTargetAnswer' => 'Befragungsziel Antwort',
	'Class:SurveyTargetAnswer+' => '',
	'Class:SurveyTargetAnswer/Attribute:contact_id' => 'Empfänger',
	'Class:SurveyTargetAnswer/Attribute:contact_name' => 'Empfänger',
	'Class:SurveyTargetAnswer/Attribute:org_id' => 'Empfängerorganisation',
	'Class:SurveyTargetAnswer/Attribute:org_name' => 'Empfängerorganisation',
	'Class:SurveyTargetAnswer/Attribute:nb_notifications_sent' => 'Anzahl der Benachrichtigungen',
	'Class:SurveyTargetAnswer/Attribute:status' => 'Status',
	'Class:SurveyTargetAnswer/Attribute:status/Value:ongoing' => 'Laufend',
	'Class:SurveyTargetAnswer/Attribute:status/Value:finished' => 'Beendet',
	'Class:SurveyTargetAnswer/Attribute:date_response' => 'Antwortdatum',
	'Class:SurveyTargetAnswer/Attribute:token' => 'Anonymisierungs Token',
	'Class:SurveyTargetAnswer/Attribute:survey_id' => 'Befragung',
	'Class:SurveyTargetAnswer/Attribute:last_question_id' => 'Letzte beantwortete Frage',

	'Class:SurveyNotification' => 'Befragungs-Email',
	'Class:SurveyNotification+' => 'Befragungs-Email',
	'Class:SurveyNotification/Attribute:survey_id' => 'Befragung',
	'Class:SurveyNotification/Attribute:survey_id+' => '',
	'Class:SurveyNotification/Attribute:contact_id' => 'Zielkontakt',
	'Class:SurveyNotification/Attribute:contact_id+' => '',

	'Survey-results-fitlering' => 'Filtern',
	'Survey-results-filter-organization' => 'Organisationen',
	'Survey-results-filter-contact' => 'Kontakte',
	'Survey-results-apply-filter' => 'Filter anwenden',
	'Survey-query-results' => 'Export der Antworten',
	'Survey-results-excel' => 'Für Excel',
	'Survey-results-csv' => 'Als CSV',
	'Survey-results-statistics' => 'Statistiken',
	'Survey-results-statistics-filtered' => 'Statistiken (gefiltert)',
	'Survey-results-noanswer' => 'Bisher keine Antwort.',
	'Survey-results-X_NonEmptyValuesOutOf_N' => '%1$d von %2$d nicht-leere Antwort(en)',
	'Survey-results-completion_X_out_of_Y_Percent' => '%1$d von %2$d Personen haben geantwortet (%3$s %% abgeschlossen)',
	'Survey-query-results-export' => 'Export',
	'Survey-results-print' => 'Druckbare Version',

	'Survey-Title-Page_X_of_Y' => '%1$s, Seite %2$d von %3$d',
	'Survey-Preview Mode' => 'Vorschau',
	'Survey-FinishButton' => 'Ende',
	'Survey-NextButton' => 'Nächste >>',
	'Survey-SuspendButton' => 'Unterbrechen',
	'Survey-CompletionNotificationSubject_name' => 'Eine weitere Antwort für die anonyme Befragung %1$s',
	'Survey-CompletionNotificationBody_url' => 'Für die anonyme Befragung $1%s wurde erneut beantwortet',
	'Survey-CompletionNotificationSubject_name_contact' => '%2$s hat an Befragung %1$s teilgenommen',
	'Survey-CompletionNotificationBody_url_contact' => '%2$s hat die Befragung $1%s abgeschlossen',
	'Survey-SurveyFinished' => 'Diese Befragung ist geschlossen. Antworten werden nicht mehr angenommen.',
	'Survey-AnswerAlreadyCommitted' => 'Ihre Antworten wurden bereits gespeichert und können nicht mehr geändert werden. Sie können dieses Fenster einfach schliessen.',
	'Survey-DefaultTitle' => 'Befragung',
	'Survey-SurveyCompleted-Title' => 'Befragung abgeschlossen',
	'Survey-SurveyCompleted-Default-Text' => 'Danke, für die Teilnahme an dieser Befragung. Ihre Antworten wurden gespeichert. Sie können dieses Fenster nun schliessen.',
	'Survey-suspend-confirmation-title' => 'Antworten gespeichert ...',
	'Survey-suspend-confirmation-message_hyperlink' => '<p>Ihre Antworten wurden gespeichert aber die Befragung wurde nicht abgeschlossen. Sie können den Browser schliessen und die Befragung unter folgendem Link fortsetzen: </p><p>%1$s</p>',
	'Survey-exit-confirmation-message' => 'Sind sie sicher, dass sie diese Seite verlassen wollen? (Ihre Antworten werden NICHT gespeichert)',

	'Survey-quizz-frame-definition' => 'Definition der Befragung',
	'Survey-quizz-frame-description' => 'Erste Seite',
	'Survey-quizz-last-page' => 'Abschlussseite',
));

//
// Class: SurveyAnswer
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:SurveyAnswer' => 'SurveyAnswer~~',
	'Class:SurveyAnswer+' => '~~',
	'Class:SurveyAnswer/Attribute:survey_target_id' => 'Survey target id~~',
	'Class:SurveyAnswer/Attribute:survey_target_id+' => '~~',
	'Class:SurveyAnswer/Attribute:question_id' => 'Question id~~',
	'Class:SurveyAnswer/Attribute:question_id+' => '~~',
	'Class:SurveyAnswer/Attribute:question_title' => 'Question title~~',
	'Class:SurveyAnswer/Attribute:question_title+' => '~~',
	'Class:SurveyAnswer/Attribute:question_description' => 'Question description~~',
	'Class:SurveyAnswer/Attribute:question_description+' => '~~',
	'Class:SurveyAnswer/Attribute:contact_id' => 'Contact id~~',
	'Class:SurveyAnswer/Attribute:contact_id+' => '~~',
	'Class:SurveyAnswer/Attribute:contact_name' => 'Contact name~~',
	'Class:SurveyAnswer/Attribute:contact_name+' => '~~',
	'Class:SurveyAnswer/Attribute:org_id' => 'Org id~~',
	'Class:SurveyAnswer/Attribute:org_id+' => '~~',
	'Class:SurveyAnswer/Attribute:org_name' => 'Org name~~',
	'Class:SurveyAnswer/Attribute:org_name+' => '~~',
	'Class:SurveyAnswer/Attribute:value' => 'Value~~',
	'Class:SurveyAnswer/Attribute:value+' => '~~',
	'Class:SurveyAnswer/Attribute:question_id_finalclass_recall' => 'Question id finalclass recall~~',
	'Class:SurveyAnswer/Attribute:question_id_finalclass_recall+' => '~~',
	'Class:SurveyAnswer/Attribute:contact_id_obsolescence_flag' => 'Contact id obsolescence flag~~',
	'Class:SurveyAnswer/Attribute:contact_id_obsolescence_flag+' => '~~',
	'Class:SurveyAnswer/Attribute:org_id_obsolescence_flag' => 'Org id obsolescence flag~~',
	'Class:SurveyAnswer/Attribute:org_id_obsolescence_flag+' => '~~',
));

//
// Class: Quizz
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:Quizz/Attribute:language/Value:Brazilian (Brazilian)' => 'Brazilian (Brazilian)~~',
	'Class:Quizz/Attribute:language/Value:Brazilian (Brazilian)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Hungarian (Magyar)' => 'Hungarian (Magyar)~~',
	'Class:Quizz/Attribute:language/Value:Hungarian (Magyar)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Chinese (简体中文)' => 'Chinese (简体中文)~~',
	'Class:Quizz/Attribute:language/Value:Chinese (简体中文)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Dutch (Nederlands)' => 'Dutch (Nederlands)~~',
	'Class:Quizz/Attribute:language/Value:Dutch (Nederlands)+' => '~~',
	'Class:Quizz/Attribute:language/Value:English (English)' => 'English (English)~~',
	'Class:Quizz/Attribute:language/Value:English (English)+' => '~~',
	'Class:Quizz/Attribute:language/Value:German (Deutsch)' => 'German (Deutsch)~~',
	'Class:Quizz/Attribute:language/Value:German (Deutsch)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Russian (Русский)' => 'Russian (Русский)~~',
	'Class:Quizz/Attribute:language/Value:Russian (Русский)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Spanish (Español, Castellaño)' => 'Spanish (Español, Castellaño)~~',
	'Class:Quizz/Attribute:language/Value:Spanish (Español, Castellaño)+' => '~~',
	'Class:Quizz/Attribute:language/Value:French (Français)' => 'French (Français)~~',
	'Class:Quizz/Attribute:language/Value:French (Français)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Japanese (日本語)' => 'Japanese (日本語)~~',
	'Class:Quizz/Attribute:language/Value:Japanese (日本語)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Turkish (Türkçe)' => 'Turkish (Türkçe)~~',
	'Class:Quizz/Attribute:language/Value:Turkish (Türkçe)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Danish (Dansk)' => 'Danish (Dansk)~~',
	'Class:Quizz/Attribute:language/Value:Danish (Dansk)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Czech (Čeština)' => 'Czech (Čeština)~~',
	'Class:Quizz/Attribute:language/Value:Czech (Čeština)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Italian (Italiano)' => 'Italian (Italiano)~~',
	'Class:Quizz/Attribute:language/Value:Italian (Italiano)+' => '~~',
));

//
// Class: QuizzElement
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:QuizzElement/Attribute:mandatory/Value:yes' => 'Yes~~',
	'Class:QuizzElement/Attribute:mandatory/Value:yes+' => '~~',
	'Class:QuizzElement/Attribute:mandatory/Value:no' => 'No~~',
	'Class:QuizzElement/Attribute:mandatory/Value:no+' => '~~',
));

//
// Class: QuizzScaleQuestion
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:QuizzScaleQuestion/Attribute:scale_values' => 'Scale values~~',
	'Class:QuizzScaleQuestion/Attribute:scale_values+' => '~~',
));

//
// Class: Survey
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:Survey/Attribute:email_on_completion/Value:yes' => 'Yes~~',
	'Class:Survey/Attribute:email_on_completion/Value:yes+' => '~~',
	'Class:Survey/Attribute:email_on_completion/Value:no' => 'No~~',
	'Class:Survey/Attribute:email_on_completion/Value:no+' => '~~',
	'Class:Survey/Attribute:survey_target_answer_list' => 'Survey target answer list~~',
	'Class:Survey/Attribute:survey_target_answer_list+' => '~~',
	'Class:Survey/Attribute:on_behalf_of_finalclass_recall' => 'On behalf of finalclass recall~~',
	'Class:Survey/Attribute:on_behalf_of_finalclass_recall+' => '~~',
	'Class:Survey/Attribute:on_behalf_of_obsolescence_flag' => 'On behalf of obsolescence flag~~',
	'Class:Survey/Attribute:on_behalf_of_obsolescence_flag+' => '~~',
));

//
// Class: SurveyTarget
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall' => 'Contact id finalclass recall~~',
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall+' => '~~',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag' => 'Contact id obsolescence flag~~',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag+' => '~~',
));

//
// Class: SurveyTargetAnswer
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall' => 'Contact id finalclass recall~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag' => 'Contact id obsolescence flag~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag' => 'Org id obsolescence flag~~',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall' => 'Last question id finalclass recall~~',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall+' => '~~',
));
