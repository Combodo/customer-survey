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
Dict::Add('FR FR', 'French', 'Français', array(
	// Dictionary entries go here
	'Survey-Title' => 'iTop Enquête client',
	'Survey-Title-Draft' => 'iTop Enquête client (mode Prévisualisation)',

	'Menu:CustomerSurvey' => 'Enquêtes de satisfaction des clients',
	'Menu:Quizzes' => 'Questionnaires',
	'Menu:Quizzes+' => 'Questionnaires',
	'Menu:Surveys' => 'Enquêtes',
	'Menu:Surveys+' => 'Enquêtes de satisfaction des clients',

	'Survey-quizz-overview' => 'Prévisualisation',
	'Survey-quizz-shortcuttoquizz' => 'Cliquez sur le lien pour prévisualiser le formulaire',
	'Survey-quizz-shortcutlabel' => 'questionnaire',

	'Survey-MandatoryQuestion' => 'Cette question est obligatoire',
	'Survey-missing-answers' => 'Veuillez donner une réponse pour toute question marquée d\'un astérisque',
	'Survey-tab-progress' => 'Avancement',
	'Survey-awaited-answers' => 'Réponses en attente',
	'Survey-progress-status' => 'Réponses, par cible (client)',
	'Survey-progress-notifications' => 'Notifications envoyées',

	'Survey-With-Selected' => 'Avec les éléments sélectionnés...',
	'Survey-Resend-Button' => 'Relancer...',
	'Survey-Resend-Title' => 'Relance',
	'Survey-Resend-Ok' => 'Relancer!',
	'Survey-Resend-Cancel' => 'Annuler',

	'Survey-tab-results' => 'Résultats',

	'Survey-notif-linktoquizz' => 'Veuillez suivre ce lien pour répondre au questionnaire',
	'Survey-form-alreadydone' => 'Vous avez déjà répondu en date du %1$s',
	'Survey-form-closed' => 'Nous sommes désolés, le sondage est terminé.',
	'Survey-form-comments' => 'Commentaires et suggestions',
	'Survey-form-submit' => 'Enregistrer vos réponses',
	'Survey-form-done' => 'Vos réponses ont été enregistrées.',
	'Survey-form-thankyou' => 'Merci pour votre participation.',

	'Survey-email-preview' => 'Prévisualisation',
	'Survey-email-notsent' => 'Echec de l\\envoi de l\\email :',
	'Survey-email-ok' => 'Email envoyé',

	'Class:Quizz' => 'Questionnaire',
	'Class:Quizz+' => '',
	'Class:Quizz/Attribute:name' => 'Nom',
	'Class:Quizz/Attribute:name+' => '',
	'Class:Quizz/Attribute:description' => 'Description',
	'Class:Quizz/Attribute:description+' => '',
	'Class:Quizz/Attribute:language' => 'Langage',
	'Class:Quizz/Attribute:language+' => '',
	'Class:Quizz/Attribute:title' => 'Titre',
	'Class:Quizz/Attribute:title+' => '',
	'Class:Quizz/Attribute:introduction' => 'Introduction',
	'Class:Quizz/Attribute:introduction+' => '',
	'Class:Quizz/Attribute:scale_values' => 'Réponses prédéfinies',
	'Class:Quizz/Attribute:conclusion?' => 'List de valeurs séparées par des virgules',
	'Class:Quizz/Attribute:conclusion' => 'Message de conclusion',
	'Class:Quizz/Attribute:conclusion+' => 'Message affiché sur la dernière page du questionnaire',
	'Class:Quizz/Attribute:survey_list' => 'Enquêtes',
	'Class:Quizz/Attribute:survey_list+' => 'Enquêtes basées sur ce questionnaire',
	'Class:Quizz/Attribute:question_list' => 'Questions',
	'Class:Quizz/Attribute:question_list+' => '',

	'Class:QuizzElement' => 'Question',
	'Class:QuizzElement+' => '',
	'Class:QuizzElement/Name' => '%1$s - %2$s',
	'Class:QuizzElement/Attribute:quizz_id' => 'Questionnaire',
	'Class:QuizzElement/Attribute:quizz_id+' => '',
	'Class:QuizzElement/Attribute:order' => 'Ordre',
	'Class:QuizzElement/Attribute:order+' => '',
	'Class:QuizzElement/Attribute:title' => 'Titre',
	'Class:QuizzElement/Attribute:title+' => '',
	'Class:QuizzElement/Attribute:description' => 'Description',
	'Class:QuizzElement/Attribute:description+' => '',
	'Class:QuizzElement/Attribute:mandatory' => 'Obligatoire',
	'Class:QuizzElement/Attribute:mandatory+' => '',
	'Class:QuizzElement/Attribute:finalclass' => 'Type de question',

	'Class:QuizzValueQuestion' => 'Question avec choix spécifiques',
	'Class:QuizzValueQuestion+' => 'Choix d\'une valeur dans une liste spécifique à cette question',
	'Class:QuizzScaleQuestion' => 'Question avec choix prédéfinies',
	'Class:QuizzScaleQuestion+' => 'Choix d\'une valeur dans la liste des réponses prédéfinies du questionnaire)',
	'Class:QuizzFreeTextQuestion' => 'Question libre',
	'Class:QuizzFreeTextQuestion+' => 'Champ de texte libre',
	'Class:QuizzNewPageElement' => 'Saut de page dans le questionnaire',
	'Class:QuizzNewPageElement+' => 'Démarre une nouvelle page pour le questionnaire',

	'Class:QuizzValueQuestion/Attribute:choices' => 'Choix possibles (séparés par des virgules)',

	'Class:Survey' => 'Enquête',
	'Class:Survey+' => '',
	'Class:Survey/Attribute:quizz_id' => 'Questionnaire',
	'Class:Survey/Attribute:quizz_id+' => '',
	'Class:Survey/Attribute:status' => 'Etat',
	'Class:Survey/Attribute:status+' => '',
	'Class:Survey/Attribute:status/Value:new' => 'Nouveau',
	'Class:Survey/Attribute:status/Value:running' => 'En cours',
	'Class:Survey/Attribute:status/Value:closed' => 'Fermé',
	'Class:Survey/Attribute:date_sent' => 'Date d\'envoi',
	'Class:Survey/Attribute:date_sent+' => '',
	'Class:Survey/Attribute:on_behalf_of' => 'De la part de',
	'Class:Survey/Attribute:on_behalf_of+' => '',
	'Class:Survey/Attribute:language' => 'Langue',
	'Class:Survey/Attribute:language+' => '',
	'Class:Survey/Attribute:email_subject' => 'Sujet de l\'email',
	'Class:Survey/Attribute:email_subject+' => '',
	'Class:Survey/Attribute:email_body' => 'Texte de l\'email (html)',
	'Class:Survey/Attribute:email_body+' => '',
	'Class:Survey/Attribute:survey_target_list' => 'Destinaires additionnels',
	'Class:Survey/Attribute:survey_target_list+' => '',
	'Class:Survey/Stimulus:ev_start' => 'Démarrer l\'enquête',
	'Class:Survey/Stimulus:ev_close' => 'Terminer l\'enquête',
	'Class:Survey/Stimulus:ev_test' => 'Envoyez-moi un échantillon de message',
	'Class:Survey/Attribute:email_on_completion' => 'Email en cas de réponse',
	'Class:Survey/Attribute:email_on_completion?' => 'Envoyer un email à l\'auteur de l\'enquête pour chaque réponse au questionnaire',
	'Class:Survey/Attribute:target_phrase_id' => 'Destinaires',
	'Class:Survey/Attribute:target_phrase_id?' => 'Définit la liste des destinaires à partir d\'une entrée du livre des requêtes',

	'Class:SurveyTarget' => 'Destinaire d\'enquête',
	'Class:SurveyTarget+' => '',
	'Class:SurveyTarget/Attribute:survey_id' => 'Enquête',
	'Class:SurveyTarget/Attribute:survey_id+' => '',
	'Class:SurveyTarget/Attribute:contact_id' => 'Contact',
	'Class:SurveyTarget/Attribute:contact_id+' => '',

	'Class:SurveyTargetAnswer' => 'Réponse d\'un destinataire',
	'Class:SurveyTargetAnswer+' => '',
	'Class:SurveyTargetAnswer/Attribute:contact_id' => 'Destinataire',
	'Class:SurveyTargetAnswer/Attribute:contact_name' => 'Destinataire',
	'Class:SurveyTargetAnswer/Attribute:org_id' => 'Organisation du destinataire',
	'Class:SurveyTargetAnswer/Attribute:org_name' => 'Organisation du destinataire',
	'Class:SurveyTargetAnswer/Attribute:nb_notifications_sent' => 'Nombre de notifications',
	'Class:SurveyTargetAnswer/Attribute:status' => 'Etat',
	'Class:SurveyTargetAnswer/Attribute:status/Value:ongoing' => 'En cours',
	'Class:SurveyTargetAnswer/Attribute:status/Value:finished' => 'Terminé',
	'Class:SurveyTargetAnswer/Attribute:date_response' => 'Date de réponse',
	'Class:SurveyTargetAnswer/Attribute:token' => 'Jeton d\'anonymisation',
	'Class:SurveyTargetAnswer/Attribute:survey_id' => 'Enquête',
	'Class:SurveyTargetAnswer/Attribute:last_question_id' => 'Dernière réponse soumise',

	'Class:SurveyNotification' => 'Email de participation à une enquête',
	'Class:SurveyNotification+' => 'Email de participation à une enquête',
	'Class:SurveyNotification/Attribute:survey_id' => 'Enquête',
	'Class:SurveyNotification/Attribute:survey_id+' => '',
	'Class:SurveyNotification/Attribute:contact_id' => 'Destinataire',
	'Class:SurveyNotification/Attribute:contact_id+' => '',

	'Survey-results-fitlering' => 'Filtrage',
	'Survey-results-filter-organization' => 'Organisations',
	'Survey-results-filter-contact' => 'Contacts',
	'Survey-results-apply-filter' => 'Filtrer',
	'Survey-query-results' => 'Export des données brutes',
	'Survey-results-excel' => 'Pour MS-Excel',
	'Survey-results-csv' => 'En CSV',
	'Survey-results-statistics' => 'Statistiques',
	'Survey-results-statistics-filtered' => 'Statistiques (filtrées)',
	'Survey-results-noanswer' => 'Aucune réponse n\'a été donnée pour le moment.',
	'Survey-results-X_NonEmptyValuesOutOf_N' => '%1$d réponse(s) non vide(s) sur %2$d',
	'Survey-results-completion_X_out_of_Y_Percent' => '%1$d personne(s) sur %2$d ont répondu (Taux de réponse: %3$s %%)',
	'Survey-query-results-export' => 'Export',
	'Survey-results-print' => 'Version imprimable',

	'Survey-Title-Page_X_of_Y' => '%1$s, page %2$d sur %3$d',
	'Survey-Preview Mode' => 'Mode aperçu',
	'Survey-FinishButton' => 'Terminer',
	'Survey-NextButton' => 'Suite >>',
	'Survey-SuspendButton' => 'Suspendre',
	'Survey-CompletionNotificationSubject_name' => 'Il y a une nouvelle réponse (anonyme) à l\'enquête %1$s',
	'Survey-CompletionNotificationBody_url' => 'L\'enquête anonyme %1$s a reçu une réponse supplémentaire',
	'Survey-CompletionNotificationSubject_name_contact' => '%2$s vient de répondre à l\'enquête %1$s',
	'Survey-CompletionNotificationBody_url_contact' => '%2$s a terminé de répondre à l\'enquête: %1$s',
	'Survey-SurveyFinished' => 'Nous sommes désolés, cette enquête est terminée. Les réponses ne sont plus acceptées.',
	'Survey-AnswerAlreadyCommitted' => 'Vos réponses à cette enquête ont déjà été enregistrées et ne peuvent plus être modifiées. Vous pouvez fermer cette fenêtre.',
	'Survey-DefaultTitle' => 'Enquête de satisfaction',
	'Survey-SurveyCompleted-Title' => 'Enquête terminée',
	'Survey-SurveyCompleted-Default-Text' => 'Merci d\'avoir répondu à cette enquête. Vos réponses ont bien été enregistrées, vous pouvez maintenant fermer cette fenêtre.',
	'Survey-suspend-confirmation-title' => 'Réponses enregistrées...',
	'Survey-suspend-confirmation-message_hyperlink' => '<p>Vos réponses ont été enregistrées mais vous n\'avez pas terminé de répondre à cette enquête. Vous pouvez revenir à cette enquête à tout moment en suivant le lien ci-dessous:</p><p>%1$s</p>',
	'Survey-exit-confirmation-message' => 'Etes-vous sûr(e) de vouloir quitter cette page ? (Vos réponses ne seront PAS enregistrées)',

	'Survey-quizz-frame-definition' => 'Définition du questionnaire',
	'Survey-quizz-frame-description' => 'En-tête du formulaire',
	'Survey-quizz-last-page' => 'Dernière page',
));

//
// Class: SurveyAnswer
//

Dict::Add('FR FR', 'French', 'Français', array(
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

Dict::Add('FR FR', 'French', 'Français', array(
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

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:QuizzElement/Attribute:mandatory/Value:yes' => 'Yes~~',
	'Class:QuizzElement/Attribute:mandatory/Value:yes+' => '~~',
	'Class:QuizzElement/Attribute:mandatory/Value:no' => 'No~~',
	'Class:QuizzElement/Attribute:mandatory/Value:no+' => '~~',
));

//
// Class: QuizzScaleQuestion
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:QuizzScaleQuestion/Attribute:scale_values' => 'Scale values~~',
	'Class:QuizzScaleQuestion/Attribute:scale_values+' => '~~',
));

//
// Class: Survey
//

Dict::Add('FR FR', 'French', 'Français', array(
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

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall' => 'Contact id finalclass recall~~',
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall+' => '~~',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag' => 'Contact id obsolescence flag~~',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag+' => '~~',
));

//
// Class: SurveyTargetAnswer
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall' => 'Contact id finalclass recall~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag' => 'Contact id obsolescence flag~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag' => 'Org id obsolescence flag~~',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall' => 'Last question id finalclass recall~~',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall+' => '~~',
));
