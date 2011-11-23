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
	'Survey-Title' => 'iTop Enquête client',
	'Survey-Title-Draft' => 'iTop Enquête client (mode Prévisualisation)',

	'Menu:CustomerSurvey' => 'Enquêtes de satisfaction des clients',
	'Menu:Quizzes' => 'Questionnaires',
	'Menu:Quizzes+' => 'Questionnaires',
	'Menu:Surveys' => 'Enquêtes',
	'Menu:Surveys+' => 'Enquêtes de satisfaction des clients',

	'Survey-quizz-frame-definition' => 'Définition privée',
	'Survey-quizz-frame-description' => 'En-tête du formulaire',

	'Survey-quizz-overview' => 'Prévisualisation',
	'Survey-quizz-shortcuttoquizz' => 'Cliquez sur le lien pour prévisualiser le formulaire',
	'Survey-quizz-shortcutlabel' => 'questionnaire',

	'Survey-MandatoryQuestion' => 'Cette question est obligatoire',
	'Survey-missing-answers' => 'Veuillez donner une réponse pour toute question marquée d\'un astérisque',
	'Survey-tab-progress' => 'Suivi',
	'Survey-awaited-answers' => 'Réponses en attente',
	'Survey-query-comments' => 'Commentaire(s)',
	'Survey-query-results' => 'Réponse(s)',
	'Survey-results-excel' => 'Pour MS-Excel',
	'Survey-results-csv' => 'Pour export en CSV',
	'Survey-results-statistics' => 'Statistiques',
	'Survey-results-comments' => 'Commentaires',
	'Survey-results-nocomment' => 'Aucun commentaire n\'est disponible pour le moment.',
	'Survey-results-noanswer' => 'Aucune réponse n\'a été donnée pour le moment.',

	'Survey-notif-linktoquizz' => 'Veuillez suivre ce lien pour répondre au questionnaire',
	'Survey-form-alreadydone' => 'Vous avez déjà répondu en date du %1$s',
	'Survey-form-closed' => 'Nous sommes désolés, le sondage est terminé.',
	'Survey-form-comments' => 'Commentaires et suggestions',
	'Survey-form-submit' => 'Enregistrer vos réponses',
	'Survey-form-done' => 'Vos réponses ont été enregistrées.',
	'Survey-form-thankyou' => 'Merci pour votre participation.',

	'Survey-email-preview' => 'Prévisualisation',
	'Survey-email-notsent' => 'Echec de l\envoi de l\email :',
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
	'Class:Quizz/Attribute:survey_list' => 'Enquêtes',
	'Class:Quizz/Attribute:survey_list+' => '',
	'Class:Quizz/Attribute:question_list' => 'Questions',
	'Class:Quizz/Attribute:question_list+' => '',

	'Class:QuizzQuestion' => 'Question',
	'Class:QuizzQuestion+' => '',
	'Class:QuizzQuestion/Name' => '%1$s - %2$s',
	'Class:QuizzQuestion/Attribute:quizz_id' => 'Questionnaire',
	'Class:QuizzQuestion/Attribute:quizz_id+' => '',
	'Class:QuizzQuestion/Attribute:order' => 'Ordre',
	'Class:QuizzQuestion/Attribute:order+' => '',
	'Class:QuizzQuestion/Attribute:title' => 'Titre',
	'Class:QuizzQuestion/Attribute:title+' => '',
	'Class:QuizzQuestion/Attribute:description' => 'Description',
	'Class:QuizzQuestion/Attribute:description+' => '',
	'Class:QuizzQuestion/Attribute:mandatory' => 'Obligatoire',
	'Class:QuizzQuestion/Attribute:mandatory+' => '',
	
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
	'Class:Survey/Attribute:survey_target_list' => 'Contacts ciblés',
	'Class:Survey/Attribute:survey_target_list+' => '',
	'Class:Survey/Attribute:notification_list' => 'Notifications',
	'Class:Survey/Attribute:notification_list+' => '',
	'Class:Survey/Stimulus:ev_start' => 'Démarrer',
	'Class:Survey/Stimulus:ev_close' => 'Arrêter',
	'Class:Survey/Stimulus:ev_test' => 'Envoyez-moi un échantillon de message',

	'Class:SurveyTarget' => 'Cible d\'enquête',
	'Class:SurveyTarget+' => '',
	'Class:SurveyTarget/Attribute:survey_id' => 'Enquête',
	'Class:SurveyTarget/Attribute:survey_id+' => '',
	'Class:SurveyTarget/Attribute:contact_id' => 'Contact',
	'Class:SurveyTarget/Attribute:contact_id+' => '',

	'Class:SurveyAnswer/Attribute:value/Value:0' => 'Très mauvais',
	'Class:SurveyAnswer/Attribute:value/Value:1' => 'Mauvais',
	'Class:SurveyAnswer/Attribute:value/Value:2' => 'Moyen',
	'Class:SurveyAnswer/Attribute:value/Value:3' => 'Bien',
	'Class:SurveyAnswer/Attribute:value/Value:4' => 'Très bien',

));

?>
