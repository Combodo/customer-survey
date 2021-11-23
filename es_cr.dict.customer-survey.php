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
Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	// Dictionary entries go here
	'Survey-Title' => 'Encuesta a Cliente',
	'Survey-Title-Draft' => 'Encuesta a Cliente (vista preliminar)',

	'Menu:CustomerSurvey' => 'Encuestas  a Cliente',
	'Menu:Quizzes' => 'Evaluaciones',
	'Menu:Quizzes+' => 'Evaluaciones',
	'Menu:Surveys' => 'Encuestas',
	'Menu:Surveys+' => 'Encuestas',

	'Survey-quizz-overview' => 'Vista preliminar',
	'Survey-quizz-shortcuttoquizz' => 'Click aquí para vista preliminar de Evaluación',
	'Survey-quizz-shortcutlabel' => 'Evaluación',

	'Survey-MandatoryQuestion' => 'Esta pregunta es obligatoria',
	'Survey-missing-answers' => 'Por favor, dr una respuesta a tods las preguntas marcadas con un asterisco.',
	'Survey-tab-progress' => 'Progreso',
	'Survey-awaited-answers' => 'Respuestas en espera',
	'Survey-progress-status' => 'Estatus de Progreso',
	'Survey-progress-notifications' => 'Notificaciones enviadas hasta el momento',

	'Survey-With-Selected' => 'Seleccionadas...',
	'Survey-Resend-Button' => 'Enviar nuevamente...',
	'Survey-Resend-Title' => 'Enviar encuesta nuevamente',
	'Survey-Resend-Ok' => 'Enviar',
	'Survey-Resend-Cancel' => 'Cancelar',

	'Survey-tab-results' => 'Resultados',

	'Survey-notif-linktoquizz' => 'Click aquí para iniciar Evaluación',
	'Survey-form-alreadydone' => 'Ya ha contestado (%1$s)',
	'Survey-form-closed' => 'Lo siento, la encuesta ha sido cerrada',
	'Survey-form-comments' => 'Comentarios y Sugerencias',
	'Survey-form-submit' => 'Registre sus respuestas',
	'Survey-form-done' => 'Sus respuestas han sido registradas.',
	'Survey-form-thankyou' => 'Gracias por su participación.',

	'Survey-email-preview' => 'Vista Preliminar',
	'Survey-email-notsent' => 'Falló en envio de correo:',
	'Survey-email-ok' => 'Mensaje enviado',

	'Class:Quizz' => 'Evaluación',
	'Class:Quizz+' => '',
	'Class:Quizz/Attribute:name' => 'Nombre',
	'Class:Quizz/Attribute:name+' => '',
	'Class:Quizz/Attribute:description' => 'Descripción',
	'Class:Quizz/Attribute:description+' => '',
	'Class:Quizz/Attribute:language' => 'Idioma de Evaluación',
	'Class:Quizz/Attribute:language+' => '',
	'Class:Quizz/Attribute:title' => 'Título',
	'Class:Quizz/Attribute:title+' => '',
	'Class:Quizz/Attribute:introduction' => 'Introducción',
	'Class:Quizz/Attribute:introduction+' => '',
	'Class:Quizz/Attribute:scale_values' => 'Opciones de Evaluación por omisión',
	'Class:Quizz/Attribute:conclusion?' => 'Lista de valores separados por coma',
	'Class:Quizz/Attribute:conclusion' => 'Mensaje de Conclusión',
	'Class:Quizz/Attribute:conclusion+' => 'Mensaje mostrado en la última página de la evaluación',
	'Class:Quizz/Attribute:survey_list' => 'Encuestas',
	'Class:Quizz/Attribute:survey_list+' => 'Encuesta basada en esta evaluación',
	'Class:Quizz/Attribute:question_list' => 'Preguntas',
	'Class:Quizz/Attribute:question_list+' => '',

	'Class:QuizzElement' => 'Elemento de Evaluación',
	'Class:QuizzElement+' => '',
	'Class:QuizzElement/Name' => '%1$s - %2$s',
	'Class:QuizzElement/Attribute:quizz_id' => 'Evaluación',
	'Class:QuizzElement/Attribute:quizz_id+' => '',
	'Class:QuizzElement/Attribute:order' => 'Orden',
	'Class:QuizzElement/Attribute:order+' => '',
	'Class:QuizzElement/Attribute:title' => 'Título',
	'Class:QuizzElement/Attribute:title+' => '',
	'Class:QuizzElement/Attribute:description' => 'Descripción',
	'Class:QuizzElement/Attribute:description+' => '',
	'Class:QuizzElement/Attribute:mandatory' => 'Obligatorio',
	'Class:QuizzElement/Attribute:mandatory+' => '',
	'Class:QuizzElement/Attribute:finalclass' => 'Tipo de Pregunta',

	'Class:QuizzValueQuestion' => 'Opciones Específicas',
	'Class:QuizzValueQuestion+' => 'Seleccione una opcion de la lista de valores (específicos para esta pregunta)',
	'Class:QuizzScaleQuestion' => 'Opciones Predefinidas',
	'Class:QuizzScaleQuestion+' => 'Seleccione una opcion de la lista de valores (predefinidos para toda la Evaluación)',
	'Class:QuizzFreeTextQuestion' => 'Texto Libre',
	'Class:QuizzFreeTextQuestion+' => 'Campo de texto libre',
	'Class:QuizzNewPageElement' => 'Salto de Página',
	'Class:QuizzNewPageElement+' => 'Iniciar una nueve página para esta Evaluación',

	'Class:QuizzValueQuestion/Attribute:choices' => 'Opciones (lista separada por comas)',

	'Class:Survey' => 'Encuesta',
	'Class:Survey+' => '',
	'Class:Survey/Attribute:quizz_id' => 'Evaluación',
	'Class:Survey/Attribute:quizz_id+' => '',
	'Class:Survey/Attribute:status' => 'Estatus',
	'Class:Survey/Attribute:status+' => '',
	'Class:Survey/Attribute:status/Value:new' => 'Nueva',
	'Class:Survey/Attribute:status/Value:running' => 'En progreso',
	'Class:Survey/Attribute:status/Value:closed' => 'Cerrada',
	'Class:Survey/Attribute:date_sent' => 'Enviada',
	'Class:Survey/Attribute:date_sent+' => '',
	'Class:Survey/Attribute:on_behalf_of' => 'A nombre de',
	'Class:Survey/Attribute:on_behalf_of+' => '',
	'Class:Survey/Attribute:language' => 'Idioma',
	'Class:Survey/Attribute:language+' => '',
	'Class:Survey/Attribute:email_subject' => 'Asunto del mensaje',
	'Class:Survey/Attribute:email_subject+' => '',
	'Class:Survey/Attribute:email_body' => 'Cuerpo del mensaje (html)',
	'Class:Survey/Attribute:email_body+' => '',
	'Class:Survey/Attribute:survey_target_list' => 'Destinatarios Adicionales',
	'Class:Survey/Attribute:survey_target_list+' => '',
	'Class:Survey/Stimulus:ev_start' => 'Iniciar la Encuesta',
	'Class:Survey/Stimulus:ev_close' => 'Finalizar la Encuesta',
	'Class:Survey/Stimulus:ev_test' => 'Enviarme un mensaje de muestra',
	'Class:Survey/Attribute:email_on_completion' => 'Correo al completar',
	'Class:Survey/Attribute:email_on_completion?' => 'Enviar correo al encuestador cuando alguien complete la encuesta.',
	'Class:Survey/Attribute:target_phrase_id' => 'Destinatarios de la Encuestra',
	'Class:Survey/Attribute:target_phrase_id?' => 'Defina los destinatarios de la encuesta basado en consulta almacenada en Libreta de Consultas',

	'Class:SurveyTarget' => 'Contacto Destino',
	'Class:SurveyTarget+' => '',
	'Class:SurveyTarget/Attribute:survey_id' => 'Encuesta',
	'Class:SurveyTarget/Attribute:survey_id+' => '',
	'Class:SurveyTarget/Attribute:contact_id' => 'Contacto',
	'Class:SurveyTarget/Attribute:contact_id+' => '',

	'Class:SurveyTargetAnswer' => 'Respuesta de Encuesta',
	'Class:SurveyTargetAnswer+' => '',
	'Class:SurveyTargetAnswer/Attribute:contact_id' => 'Destinatario',
	'Class:SurveyTargetAnswer/Attribute:contact_name' => 'Nombre Destinatario',
	'Class:SurveyTargetAnswer/Attribute:org_id' => 'Organización del Destinatario',
	'Class:SurveyTargetAnswer/Attribute:org_name' => 'Organización del Destinatario',
	'Class:SurveyTargetAnswer/Attribute:nb_notifications_sent' => 'Número de notificaciones',
	'Class:SurveyTargetAnswer/Attribute:status' => 'Estatus',
	'Class:SurveyTargetAnswer/Attribute:status/Value:ongoing' => 'En proceso',
	'Class:SurveyTargetAnswer/Attribute:status/Value:finished' => 'Finalizada',
	'Class:SurveyTargetAnswer/Attribute:date_response' => 'Fecha de Respuesta',
	'Class:SurveyTargetAnswer/Attribute:token' => 'Token Anónimo',
	'Class:SurveyTargetAnswer/Attribute:survey_id' => 'Encuesta',
	'Class:SurveyTargetAnswer/Attribute:last_question_id' => 'Última pregunta respondida',

	'Class:SurveyNotification' => 'Correo de Encuesta',
	'Class:SurveyNotification+' => 'Correo de Encuesta',
	'Class:SurveyNotification/Attribute:survey_id' => 'Encuesta',
	'Class:SurveyNotification/Attribute:survey_id+' => '',
	'Class:SurveyNotification/Attribute:contact_id' => 'Destinatario',
	'Class:SurveyNotification/Attribute:contact_id+' => '',

	'Survey-results-fitlering' => 'Filtrado',
	'Survey-results-filter-organization' => 'Organizaciones',
	'Survey-results-filter-contact' => 'Contactos',
	'Survey-results-apply-filter' => 'Aplicar Filtro',
	'Survey-query-results' => 'Exportar Respuestas',
	'Survey-results-excel' => 'para Excel',
	'Survey-results-csv' => 'como CSV',
	'Survey-results-statistics' => 'Estadísticas',
	'Survey-results-statistics-filtered' => 'Estadísticas (filtradas)',
	'Survey-results-noanswer' => 'No se ha recibido respuesta todavía.',
	'Survey-results-X_NonEmptyValuesOutOf_N' => '%1$d respuesta de  %2$d',
	'Survey-results-completion_X_out_of_Y_Percent' => '%1$d personas de %2$d respondieron (%3$s %% completado)',
	'Survey-query-results-export' => 'Exportar',
	'Survey-results-print' => 'Versión Imprimible',

	'Survey-Title-Page_X_of_Y' => '%1$s, página %2$d de %3$d',
	'Survey-Preview Mode' => 'Modo Vista Preliminar',
	'Survey-FinishButton' => 'Finalizar',
	'Survey-NextButton' => 'Sigueinte >>',
	'Survey-SuspendButton' => 'Suspender',
	'Survey-CompletionNotificationSubject_name' => 'Una respuesta mas para la encuesta anónima %1$s',
	'Survey-CompletionNotificationBody_url' => 'La encuesta anónima: $1%s acaba de recibir una respuesta más',
	'Survey-CompletionNotificationSubject_name_contact' => '%2$s acaba de contestar la encuesta %1$s',
	'Survey-CompletionNotificationBody_url_contact' => '%2$s completó la encuesta: $1%s',
	'Survey-SurveyFinished' => 'Esta encuesta está cerrada. Las respuestas ya no son aceptadas.',
	'Survey-AnswerAlreadyCommitted' => 'Sus respuestas para esta encuestra an sido registradas y ya no pueden ser modificadas. Puede cerrar esta ventana.',
	'Survey-DefaultTitle' => 'Encuesta',
	'Survey-SurveyCompleted-Title' => 'Encuesta Completada',
	'Survey-SurveyCompleted-Default-Text' => 'Gracias por completar esta encuesta. Sus respuestas han sido registradas. Puede cerrar esta ventana.',
	'Survey-suspend-confirmation-title' => 'Respuestas guardadas...',
	'Survey-suspend-confirmation-message_hyperlink' => '<p>Sus respuestas han sido guardadas, pero la encuesta no está completa. Puede cerrar la ventana y regresar después y terminar la encuesta usando esta liga:</p><p>%1$s</p>',
	'Survey-exit-confirmation-message' => 'Está seguro de querer abandonoar está página? (Sus respuestas NO serán guardadas)',

	'Survey-quizz-frame-definition' => 'Definición de Encuesta',
	'Survey-quizz-frame-description' => 'Primer Página',
	'Survey-quizz-last-page' => 'Página de Cierre',
));

//
// Class: SurveyAnswer
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
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

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
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
	'Class:Quizz/Attribute:language/Value:Spanish (Español, Castellano)' => 'Spanish (Español, Castellano)~~',
	'Class:Quizz/Attribute:language/Value:Spanish (Español, Castellano)+' => '~~',
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

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:QuizzElement/Attribute:mandatory/Value:yes' => 'Yes~~',
	'Class:QuizzElement/Attribute:mandatory/Value:yes+' => '~~',
	'Class:QuizzElement/Attribute:mandatory/Value:no' => 'No~~',
	'Class:QuizzElement/Attribute:mandatory/Value:no+' => '~~',
));

//
// Class: QuizzScaleQuestion
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:QuizzScaleQuestion/Attribute:scale_values' => 'Scale values~~',
	'Class:QuizzScaleQuestion/Attribute:scale_values+' => '~~',
));

//
// Class: Survey
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
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

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall' => 'Contact id finalclass recall~~',
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall+' => '~~',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag' => 'Contact id obsolescence flag~~',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag+' => '~~',
));

//
// Class: SurveyTargetAnswer
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall' => 'Contact id finalclass recall~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag' => 'Contact id obsolescence flag~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag' => 'Org id obsolescence flag~~',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall' => 'Last question id finalclass recall~~',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall+' => '~~',
));
