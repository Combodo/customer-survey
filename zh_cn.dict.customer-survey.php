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
Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	// Dictionary entries go here
	'Survey-Title' => 'iTop客户调查',
	'Survey-Title-Draft' => 'iTop客户调查 (预览模式)',
	'Menu:CustomerSurvey' => '客户调查',
	'Menu:Quizzes' => '问卷',
	'Menu:Quizzes+' => '问卷',
	'Menu:Surveys' => '调查',
	'Menu:Surveys+' => '调查',
	'Survey-quizz-overview' => '预览',
	'Survey-quizz-shortcuttoquizz' => '点击预览此问卷',
	'Survey-quizz-shortcutlabel' => '问卷',
	'Survey-MandatoryQuestion' => '这个问题是必填的',
	'Survey-missing-answers' => '请回答所有标记为星号的问题.',
	'Survey-tab-progress' => '进度',
	'Survey-awaited-answers' => '等待完成',
	'Survey-progress-status' => '按调查对象的进度',
	'Survey-progress-notifications' => '已发送通知',
	'Survey-With-Selected' => '已选择...',
	'Survey-Resend-Button' => '重新发送...',
	'Survey-Resend-Title' => '重新发送调查',
	'Survey-Resend-Ok' => '发送!',
	'Survey-Resend-Cancel' => '取消',
	'Survey-tab-results' => '结果',
	'Survey-notif-linktoquizz' => '点击开始此问卷',
	'Survey-form-alreadydone' => '您已经完成了此问卷 (%1$s)',
	'Survey-form-closed' => '抱歉, 此调查已关闭',
	'Survey-form-comments' => '其他建议和意见',
	'Survey-form-submit' => '记录您的回答',
	'Survey-form-done' => '您的回答已记录.',
	'Survey-form-thankyou' => '感谢您的参与.',
	'Survey-email-preview' => '预览',
	'Survey-email-notsent' => '发送邮件失败:',
	'Survey-email-ok' => '邮件已发送',
	'Class:Quizz' => '问卷',
	'Class:Quizz+' => '~~',
	'Class:Quizz/Attribute:name' => '名称',
	'Class:Quizz/Attribute:name+' => '~~',
	'Class:Quizz/Attribute:description' => '说明',
	'Class:Quizz/Attribute:description+' => '~~',
	'Class:Quizz/Attribute:language' => '问卷语言',
	'Class:Quizz/Attribute:language+' => '~~',
	'Class:Quizz/Attribute:title' => '标题',
	'Class:Quizz/Attribute:title+' => '~~',
	'Class:Quizz/Attribute:introduction' => '介绍',
	'Class:Quizz/Attribute:introduction+' => '~~',
	'Class:Quizz/Attribute:scale_values' => '问卷缺省选项',
	'Class:Quizz/Attribute:conclusion?' => '值用逗号分隔',
	'Class:Quizz/Attribute:conclusion' => '结尾信息',
	'Class:Quizz/Attribute:conclusion+' => '显示在问卷最后一页的信息',
	'Class:Quizz/Attribute:survey_list' => '调查',
	'Class:Quizz/Attribute:survey_list+' => '适用此问卷的调查',
	'Class:Quizz/Attribute:question_list' => '问题',
	'Class:Quizz/Attribute:question_list+' => '~~',
	'Class:QuizzElement' => '问卷元素',
	'Class:QuizzElement+' => '~~',
	'Class:QuizzElement/Name' => '%1$s - %2$s',
	'Class:QuizzElement/Attribute:quizz_id' => '问卷',
	'Class:QuizzElement/Attribute:quizz_id+' => '~~',
	'Class:QuizzElement/Attribute:order' => '排序',
	'Class:QuizzElement/Attribute:order+' => '~~',
	'Class:QuizzElement/Attribute:title' => '标题',
	'Class:QuizzElement/Attribute:title+' => '~~',
	'Class:QuizzElement/Attribute:description' => '说明',
	'Class:QuizzElement/Attribute:description+' => '~~',
	'Class:QuizzElement/Attribute:mandatory' => '必填项',
	'Class:QuizzElement/Attribute:mandatory+' => '~~',
	'Class:QuizzElement/Attribute:finalclass' => '问题类型',
	'Class:QuizzValueQuestion' => '自定义选项',
	'Class:QuizzValueQuestion+' => '从列表中选择一个选项 (此问题自定义的)',
	'Class:QuizzValueQuestion/Name' => '%1$s) %2$s',
	'Class:QuizzValueQuestion/Attribute:choices' => '选项 (用逗号分隔)',
	'Class:QuizzScaleQuestion' => '预定义选项',
	'Class:QuizzScaleQuestion+' => '从列表中选择一个选项 (问卷预定义的)',
	'Class:QuizzScaleQuestion/Name' => '%1$s) %2$s',
	'Class:QuizzFreeTextQuestion' => '自由文本',
	'Class:QuizzFreeTextQuestion+' => '自由文本字段',
	'Class:QuizzFreeTextQuestion/Name' => '%1$s) %2$s',
	'Class:QuizzNewPageElement' => '分页',
	'Class:QuizzNewPageElement+' => '在问卷中开始一个新页面',
	'Class:QuizzNewPageElement/Name' => '%1$s) %2$s',
	'Class:Survey' => '调查',
	'Class:Survey+' => '~~',
	'Class:Survey/Name' => '%1$s / %2$s',
	'Class:Survey/Attribute:quizz_id' => '问卷',
	'Class:Survey/Attribute:quizz_id+' => '~~',
	'Class:Survey/Attribute:status' => '状态',
	'Class:Survey/Attribute:status+' => '~~',
	'Class:Survey/Attribute:status/Value:new' => '新建的',
	'Class:Survey/Attribute:status/Value:running' => '进行中',
	'Class:Survey/Attribute:status/Value:closed' => '已关闭',
	'Class:Survey/Attribute:date_sent' => '已发送',
	'Class:Survey/Attribute:date_sent+' => '~~',
	'Class:Survey/Attribute:on_behalf_of' => '名义代表',
	'Class:Survey/Attribute:on_behalf_of+' => '~~',
	'Class:Survey/Attribute:language' => '语言',
	'Class:Survey/Attribute:language+' => '~~',
	'Class:Survey/Attribute:email_subject' => '邮件主题',
	'Class:Survey/Attribute:email_subject+' => '~~',
	'Class:Survey/Attribute:email_body' => '邮件正文 (html)',
	'Class:Survey/Attribute:email_body+' => '~~',
	'Class:Survey/Attribute:survey_target_list' => '额外的收件人',
	'Class:Survey/Attribute:survey_target_list+' => '~~',
	'Class:Survey/Stimulus:ev_start' => '开始此调查',
	'Class:Survey/Stimulus:ev_close' => '终止此调查',
	'Class:Survey/Stimulus:ev_test' => '发送示例信息',
	'Class:Survey/Attribute:email_on_completion' => '完成时发送邮件',
	'Class:Survey/Attribute:email_on_completion?' => '当有人完成此调查后发送邮件给调查发起人.',
	'Class:Survey/Attribute:target_phrase_id' => '调查收件人',
	'Class:Survey/Attribute:target_phrase_id?' => '使用查询薄中保存的查询来规定调查收件人',
	'Class:SurveyTarget' => '调查对象联系人',
	'Class:SurveyTarget+' => '~~',
	'Class:SurveyTarget/Attribute:survey_id' => '调查',
	'Class:SurveyTarget/Attribute:survey_id+' => '~~',
	'Class:SurveyTarget/Attribute:contact_id' => '联系人',
	'Class:SurveyTarget/Attribute:contact_id+' => '~~',
	'Class:SurveyTargetAnswer' => '调查对象答卷',
	'Class:SurveyTargetAnswer+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id' => '收件人',
	'Class:SurveyTargetAnswer/Attribute:contact_name' => '收件人',
	'Class:SurveyTargetAnswer/Attribute:org_id' => '收件人组织',
	'Class:SurveyTargetAnswer/Attribute:org_name' => '收件人组织',
	'Class:SurveyTargetAnswer/Attribute:nb_notifications_sent' => '通知数',
	'Class:SurveyTargetAnswer/Attribute:status' => '状态',
	'Class:SurveyTargetAnswer/Attribute:status/Value:ongoing' => '进行中',
	'Class:SurveyTargetAnswer/Attribute:status/Value:finished' => '已完成',
	'Class:SurveyTargetAnswer/Attribute:date_response' => '答卷日期',
	'Class:SurveyTargetAnswer/Attribute:token' => '匿名化令牌',
	'Class:SurveyTargetAnswer/Attribute:survey_id' => '调查',
	'Class:SurveyTargetAnswer/Attribute:last_question_id' => '答卷的最后一个问题',
	'Class:SurveyNotification' => '调查邮件',
	'Class:SurveyNotification+' => '调查邮件',
	'Class:SurveyNotification/Attribute:survey_id' => '调查',
	'Class:SurveyNotification/Attribute:survey_id+' => '~~',
	'Class:SurveyNotification/Attribute:contact_id' => '调查对象联系人',
	'Class:SurveyNotification/Attribute:contact_id+' => '~~',
	'Survey-results-fitlering' => '筛选',
	'Survey-results-filter-organization' => '组织',
	'Survey-results-filter-contact' => '联系人',
	'Survey-results-apply-filter' => '应用筛选',
	'Survey-query-results' => '导出答卷原始记录',
	'Survey-results-excel' => 'Excel格式',
	'Survey-results-csv' => 'CSV格式',
	'Survey-results-statistics' => '统计',
	'Survey-results-statistics-filtered' => '统计 (已筛选)',
	'Survey-results-noanswer' => '当前尚无答卷.',
	'Survey-results-X_NonEmptyValuesOutOf_N' => '总计%2$d中的%1$d个非空答卷',
	'Survey-results-completion_X_out_of_Y_Percent' => '总计%2$d中的%1$d个人员已答卷 (%3$s %% 完成)~~',
	'Survey-query-results-export' => '导出',
	'Survey-results-print' => '打印版本',
	'Survey-Title-Page_X_of_Y' => '%1$s, 第%2$d页, 共%3$d页',
	'Survey-Preview Mode' => '预览模式',
	'Survey-FinishButton' => '完成',
	'Survey-NextButton' => '下一页 >>',
	'Survey-SuspendButton' => '暂停',
	'Survey-CompletionNotificationSubject_name' => '有一份答卷来自匿名调查%1$s',
	'Survey-CompletionNotificationBody_url' => '此匿名调查: %1$s刚刚收到一份答卷',
	'Survey-CompletionNotificationSubject_name_contact' => '%2$s刚刚答卷了此调查%1$s',
	'Survey-CompletionNotificationBody_url_contact' => '%2$s完成了此调查: %1$s',
	'Survey-SurveyFinished' => '此调查已关闭. 不再接收答卷.',
	'Survey-AnswerAlreadyCommitted' => '您对此调查的回答已记录, 无法修改. 您现在可以安全的关闭此窗口.',
	'Survey-DefaultTitle' => '调查',
	'Survey-SurveyCompleted-Title' => '调查已完成',
	'Survey-SurveyCompleted-Default-Text' => '感谢您完成此调查. 您的回答已记录. 您现在可以安全的关闭此窗口.',
	'Survey-suspend-confirmation-title' => '回答已保存...',
	'Survey-suspend-confirmation-message_hyperlink' => '<p>您的回答已保存, 但是尚未完成调查. 您现在可以关闭浏览器, 并在以后点击此链接以完成调查:</p><p>%1$s</p>',
	'Survey-exit-confirmation-message' => '确定要离开当前页面吗? (您的回答将不被保存)',
	'Survey-quizz-frame-definition' => '调查定义',
	'Survey-quizz-frame-description' => '首页',
	'Survey-quizz-last-page' => '关闭页',
));

//
// Class: SurveyAnswer
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:SurveyAnswer' => '调查答卷',
	'Class:SurveyAnswer+' => '~~',
	'Class:SurveyAnswer/Attribute:survey_target_id' => '调查对象',
	'Class:SurveyAnswer/Attribute:survey_target_id+' => '~~',
	'Class:SurveyAnswer/Attribute:question_id' => '问题',
	'Class:SurveyAnswer/Attribute:question_id+' => '~~',
	'Class:SurveyAnswer/Attribute:question_title' => '问题标题',
	'Class:SurveyAnswer/Attribute:question_title+' => '~~',
	'Class:SurveyAnswer/Attribute:question_description' => '问题说明',
	'Class:SurveyAnswer/Attribute:question_description+' => '~~',
	'Class:SurveyAnswer/Attribute:contact_id' => '联系人',
	'Class:SurveyAnswer/Attribute:contact_id+' => '~~',
	'Class:SurveyAnswer/Attribute:contact_name' => '联系人姓名',
	'Class:SurveyAnswer/Attribute:contact_name+' => '~~',
	'Class:SurveyAnswer/Attribute:org_id' => '组织',
	'Class:SurveyAnswer/Attribute:org_id+' => '~~',
	'Class:SurveyAnswer/Attribute:org_name' => '组织名称',
	'Class:SurveyAnswer/Attribute:org_name+' => '~~',
	'Class:SurveyAnswer/Attribute:value' => '值',
	'Class:SurveyAnswer/Attribute:value+' => '~~',
	'Class:SurveyAnswer/Attribute:question_id_finalclass_recall' => '问题类型',
	'Class:SurveyAnswer/Attribute:question_id_finalclass_recall+' => '~~',
	'Class:SurveyAnswer/Attribute:contact_id_obsolescence_flag' => '联系人废弃标记',
	'Class:SurveyAnswer/Attribute:contact_id_obsolescence_flag+' => '~~',
	'Class:SurveyAnswer/Attribute:org_id_obsolescence_flag' => '组织废弃标记',
	'Class:SurveyAnswer/Attribute:org_id_obsolescence_flag+' => '~~',
));

//
// Class: Quizz
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:Quizz/Attribute:language/Value:Brazilian (Brazilian)' => 'Brazilian (Brazilian)~~',
	'Class:Quizz/Attribute:language/Value:Brazilian (Brazilian)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Hungarian (Magyar)' => 'Hungarian (Magyar)~~',
	'Class:Quizz/Attribute:language/Value:Hungarian (Magyar)+' => '~~',
	'Class:Quizz/Attribute:language/Value:Chinese (简体中文)' => 'Chinese (简体中文)',
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

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:QuizzElement/Attribute:mandatory/Value:yes' => '是',
	'Class:QuizzElement/Attribute:mandatory/Value:yes+' => '~~',
	'Class:QuizzElement/Attribute:mandatory/Value:no' => '否',
	'Class:QuizzElement/Attribute:mandatory/Value:no+' => '~~',
));

//
// Class: QuizzScaleQuestion
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:QuizzScaleQuestion/Attribute:scale_values' => '范围值',
	'Class:QuizzScaleQuestion/Attribute:scale_values+' => '~~',
));

//
// Class: Survey
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:Survey/Attribute:email_on_completion/Value:yes' => '是',
	'Class:Survey/Attribute:email_on_completion/Value:yes+' => '~~',
	'Class:Survey/Attribute:email_on_completion/Value:no' => '否',
	'Class:Survey/Attribute:email_on_completion/Value:no+' => '~~',
	'Class:Survey/Attribute:survey_target_answer_list' => '调查对象答卷列表',
	'Class:Survey/Attribute:survey_target_answer_list+' => '~~',
	'Class:Survey/Attribute:on_behalf_of_finalclass_recall' => '名义代表类型',
	'Class:Survey/Attribute:on_behalf_of_finalclass_recall+' => '~~',
	'Class:Survey/Attribute:on_behalf_of_obsolescence_flag' => '名义代表废弃标记',
	'Class:Survey/Attribute:on_behalf_of_obsolescence_flag+' => '~~',
));

//
// Class: SurveyTarget
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall' => '联系人类型',
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall+' => '~~',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag' => '联系人废弃标记',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag+' => '~~',
));

//
// Class: SurveyTargetAnswer
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall' => '联系人类型',
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag' => '联系人废弃标记',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag' => '组织废弃标记',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag+' => '~~',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall' => '最后问题类型',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall+' => '~~',
));
