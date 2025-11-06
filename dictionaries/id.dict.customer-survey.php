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

Dict::Add('ID ID', 'Indonesian', 'Bahasa', array(
	// Dictionary entries go here
	'Survey-Title' => 'Survei Pelanggan iTop',
	'Survey-Title-Draft' => 'Survei Pelanggan iTop (mode pratinjau)',

	'Menu:CustomerSurvey' => 'Survei pelanggan',
	'Menu:Quizzes' => 'Kuis',
	'Menu:Quizzes+' => 'Kuis',
	'Menu:Surveys' => 'Survei',
	'Menu:Surveys+' => 'Survei',

	'Survey-quizz-overview' => 'Pratinjau',
	'Survey-quizz-shortcuttoquizz' => 'Klik di sini untuk melihat pratinjau Kuis',
	'Survey-quizz-shortcutlabel' => 'kuis',

	'Survey-MandatoryQuestion' => 'Pertanyaan ini wajib dijawab',
	'Survey-missing-answers' => 'Harap berikan jawaban untuk semua pertanyaan yang ditandai dengan tanda bintang.',
	'Survey-tab-progress' => 'Kemajuan',
	'Survey-awaited-answers' => 'Jawaban yang masih ditunggu',
	'Survey-progress-status' => 'Kemajuan berdasarkan target',
	'Survey-progress-notifications' => 'Notifikasi yang telah dikirim',

	'Survey-With-Selected' => 'Dengan yang dipilih...',
	'Survey-Resend-Button' => 'Kirim lagi...',
	'Survey-Resend-Title' => 'Kirim survei lagi',
	'Survey-Resend-Ok' => 'Kirim!',
	'Survey-Resend-Cancel' => 'Batal',

	'Survey-tab-results' => 'Hasil',

	'Survey-notif-linktoquizz' => 'Klik di sini untuk memulai Kuis',
	'Survey-form-alreadydone' => 'Anda sudah menjawab (%1$s)',
	'Survey-form-closed' => 'Maaf, survei telah ditutup',
	'Survey-form-comments' => 'Komentar dan saran bebas',
	'Survey-form-submit' => 'Rekam jawaban Anda',
	'Survey-form-done' => 'Jawaban Anda telah direkam.',
	'Survey-form-thankyou' => 'Terima kasih atas partisipasi Anda.',

	'Survey-email-preview' => 'Pratinjau',
	'Survey-email-notsent' => 'Gagal mengirim email:',
	'Survey-email-ok' => 'Email terkirim',

	'Class:Quizz' => 'Kuis',
	'Class:Quizz+' => '',
	'Class:Quizz/Attribute:name' => 'Nama',
	'Class:Quizz/Attribute:name+' => '',
	'Class:Quizz/Attribute:description' => 'Deskripsi',
	'Class:Quizz/Attribute:description+' => '',
	'Class:Quizz/Attribute:language' => 'Bahasa Kuis',
	'Class:Quizz/Attribute:language+' => '',
	'Class:Quizz/Attribute:title' => 'Judul',
	'Class:Quizz/Attribute:title+' => '',
	'Class:Quizz/Attribute:introduction' => 'Pengantar',
	'Class:Quizz/Attribute:introduction+' => '',
	'Class:Quizz/Attribute:scale_values' => 'Pilihan Default Kuis',
	'Class:Quizz/Attribute:conclusion?' => 'Daftar nilai yang dipisahkan koma',
	'Class:Quizz/Attribute:conclusion' => 'Pesan kesimpulan',
	'Class:Quizz/Attribute:conclusion+' => 'Pesan yang ditampilkan di halaman terakhir kuis',
	'Class:Quizz/Attribute:survey_list' => 'Survei',
	'Class:Quizz/Attribute:survey_list+' => 'Survei berdasarkan kuis ini',
	'Class:Quizz/Attribute:question_list' => 'Pertanyaan',
	'Class:Quizz/Attribute:question_list+' => '',

	'Class:QuizzElement' => 'Elemen kuis',
	'Class:QuizzElement+' => '',
	'Class:QuizzElement/Name' => '%1$s - %2$s',
	'Class:QuizzElement/Attribute:quizz_id' => 'Kuis',
	'Class:QuizzElement/Attribute:quizz_id+' => '',
	'Class:QuizzElement/Attribute:order' => 'Urutan',
	'Class:QuizzElement/Attribute:order+' => '',
	'Class:QuizzElement/Attribute:title' => 'Judul',
	'Class:QuizzElement/Attribute:title+' => '',
	'Class:QuizzElement/Attribute:description' => 'Deskripsi',
	'Class:QuizzElement/Attribute:description+' => '',
	'Class:QuizzElement/Attribute:mandatory' => 'Wajib',
	'Class:QuizzElement/Attribute:mandatory+' => '',
	'Class:QuizzElement/Attribute:finalclass' => 'Jenis Pertanyaan',

	'Class:QuizzValueQuestion' => 'Pertanyaan pilihan khusus',
	'Class:QuizzValueQuestion+' => 'Pilih satu pilihan dari daftar nilai (khusus untuk pertanyaan ini)',
    'Class:QuizzValueQuestion/Name' => '%1$s) %2$s',
    'Class:QuizzValueQuestion/Attribute:choices' => 'Pilihan (daftar yang dipisahkan koma)',

	'Class:QuizzScaleQuestion' => 'Pertanyaan pilihan yang telah ditentukan',
	'Class:QuizzScaleQuestion+' => 'Pilih satu pilihan dari daftar nilai (telah ditentukan untuk seluruh kuis)',
    'Class:QuizzScaleQuestion/Name' => '%1$s) %2$s',

	'Class:QuizzFreeTextQuestion' => 'Pertanyaan bebas',
	'Class:QuizzFreeTextQuestion+' => 'Bidang teks bebas',
    'Class:QuizzFreeTextQuestion/Name' => '%1$s) %2$s',

	'Class:QuizzNewPageElement' => 'Pemisah halaman dalam kuis',
	'Class:QuizzNewPageElement+' => 'Mulai halaman baru untuk kuis',
    'Class:QuizzNewPageElement/Name' => '%1$s) %2$s',

	'Class:Survey' => 'Survei',
	'Class:Survey+' => '',
    'Class:Survey/Name' => '%1$s / %2$s',
	'Class:Survey/Attribute:quizz_id' => 'Kuis',
	'Class:Survey/Attribute:quizz_id+' => '',
	'Class:Survey/Attribute:status' => 'Status',
	'Class:Survey/Attribute:status+' => '',
	'Class:Survey/Attribute:status/Value:new' => 'Baru',
	'Class:Survey/Attribute:status/Value:running' => 'Sedang Berlangsung',
	'Class:Survey/Attribute:status/Value:closed' => 'Ditutup',
	'Class:Survey/Attribute:date_sent' => 'Dikirim',
	'Class:Survey/Attribute:date_sent+' => '',
	'Class:Survey/Attribute:on_behalf_of' => 'Atas nama',
	'Class:Survey/Attribute:on_behalf_of+' => '',
	'Class:Survey/Attribute:language' => 'Bahasa',
	'Class:Survey/Attribute:language+' => '',
	'Class:Survey/Attribute:email_subject' => 'Subjek email',
	'Class:Survey/Attribute:email_subject+' => '',
	'Class:Survey/Attribute:email_body' => 'Isi email (html)',
	'Class:Survey/Attribute:email_body+' => '',
	'Class:Survey/Attribute:survey_target_list' => 'Penerima Tambahan',
	'Class:Survey/Attribute:survey_target_list+' => '',
	'Class:Survey/Stimulus:ev_start' => 'Mulai Survei',
	'Class:Survey/Stimulus:ev_close' => 'Tutup Survei',
	'Class:Survey/Stimulus:ev_test' => 'Kirim saya pesan contoh',
	'Class:Survey/Attribute:email_on_completion' => 'Email saat selesai',
	'Class:Survey/Attribute:email_on_completion?' => 'Kirim email kepada pengirim survei ketika seseorang menyelesaikan survei.',
	'Class:Survey/Attribute:target_phrase_id' => 'Penerima Survei',
	'Class:Survey/Attribute:target_phrase_id?' => 'Tentukan penerima survei berdasarkan kueri yang disimpan dalam Phrasebook',

	'Class:SurveyTarget' => 'Kontak yang disurvei',
	'Class:SurveyTarget+' => '',
	'Class:SurveyTarget/Attribute:survey_id' => 'Survei',
	'Class:SurveyTarget/Attribute:survey_id+' => '',
	'Class:SurveyTarget/Attribute:contact_id' => 'Kontak',
	'Class:SurveyTarget/Attribute:contact_id+' => '',
	'Class:SurveyTargetAnswer' => 'Jawaban Target Survei',
	'Class:SurveyTargetAnswer+' => '',
	'Class:SurveyTargetAnswer/Attribute:contact_id' => 'Penerima',
	'Class:SurveyTargetAnswer/Attribute:contact_name' => 'Penerima',
	'Class:SurveyTargetAnswer/Attribute:org_id' => 'Organisasi Penerima',
	'Class:SurveyTargetAnswer/Attribute:org_name' => 'Organisasi Penerima',
	'Class:SurveyTargetAnswer/Attribute:nb_notifications_sent' => 'Jumlah notifikasi',
	'Class:SurveyTargetAnswer/Attribute:status' => 'Status',
	'Class:SurveyTargetAnswer/Attribute:status/Value:ongoing' => 'Sedang berlangsung',
	'Class:SurveyTargetAnswer/Attribute:status/Value:finished' => 'Selesai',
	'Class:SurveyTargetAnswer/Attribute:date_response' => 'Tanggal jawaban',
	'Class:SurveyTargetAnswer/Attribute:token' => 'Token Anonimisasi',
	'Class:SurveyTargetAnswer/Attribute:survey_id' => 'Survei',
	'Class:SurveyTargetAnswer/Attribute:last_question_id' => 'Pertanyaan terakhir yang dijawab',

	'Class:SurveyNotification' => 'Email Survei',
	'Class:SurveyNotification+' => 'Email Survei',
	'Class:SurveyNotification/Attribute:survey_id' => 'Survei',
	'Class:SurveyNotification/Attribute:survey_id+' => '',
	'Class:SurveyNotification/Attribute:contact_id' => 'Kontak target',
	'Class:SurveyNotification/Attribute:contact_id+' => '',

	'Survey-results-fitlering' => 'Penyaringan',
	'Survey-results-filter-organization' => 'Organisasi',
	'Survey-results-filter-contact' => 'Kontak',
	'Survey-results-apply-filter' => 'Terapkan Filter',
	'Survey-query-results' => 'Ekspor Jawaban Mentah',
	'Survey-results-excel' => 'Untuk Excel',
	'Survey-results-csv' => 'Sebagai CSV',
	'Survey-results-statistics' => 'Statistik',
	'Survey-results-statistics-filtered' => 'Statistik (disaring)',
	'Survey-results-noanswer' => 'Belum ada jawaban yang diberikan.',
	'Survey-results-X_NonEmptyValuesOutOf_N' => '%1$d jawaban tidak kosong dari %2$d',
	'Survey-results-completion_X_out_of_Y_Percent' => '%1$d orang dari %2$d menjawab (%3$s %% selesai)',
	'Survey-query-results-export' => 'Ekspor',
	'Survey-results-print' => 'Versi cetak',

	'Survey-Title-Page_X_of_Y' => '%1$s, halaman %2$d dari %3$d',
	'Survey-Preview Mode' => 'Mode pratinjau',
	'Survey-FinishButton' => 'Selesai',
	'Survey-NextButton' => 'Selanjutnya >>',
	'Survey-SuspendButton' => 'Tunda',
	'Survey-CompletionNotificationSubject_name' => 'Satu jawaban lagi untuk survei anonim %1$s',
	'Survey-CompletionNotificationBody_url' => 'Survei anonim: %1$s baru mendapat satu jawaban lagi',
	'Survey-CompletionNotificationSubject_name_contact' => '%2$s baru saja menjawab survei %1$s',
	'Survey-CompletionNotificationBody_url_contact' => '%2$s menyelesaikan survei: %1$s',
	'Survey-SurveyFinished' => 'Survei ini ditutup. Jawaban tidak lagi diterima.',
	'Survey-AnswerAlreadyCommitted' => 'Jawaban Anda untuk survei ini telah direkam dan tidak dapat lagi dimodifikasi. Anda sekarang dapat menutup jendela ini dengan aman.',
	'Survey-DefaultTitle' => 'Survei',
	'Survey-SurveyCompleted-Title' => 'Survei Selesai',
	'Survey-SurveyCompleted-Default-Text' => 'Terima kasih telah menyelesaikan survei ini. Jawaban Anda telah direkam. Anda sekarang dapat menutup jendela ini dengan aman.',
	'Survey-suspend-confirmation-title' => 'Jawaban disimpan...',
	'Survey-suspend-confirmation-message_hyperlink' => '<p>Jawaban Anda telah disimpan, tetapi survei belum selesai. Anda dapat menutup browser dan kembali lagi nanti untuk menyelesaikan survei menggunakan tautan ini:</p><p>%1$s</p>',
	'Survey-exit-confirmation-message' => 'Apakah Anda yakin ingin meninggalkan halaman? (Jawaban Anda TIDAK akan disimpan)',

	'Survey-quizz-frame-definition' => 'Definisi Survei',
	'Survey-quizz-frame-description' => 'Halaman Pertama',
	'Survey-quizz-last-page' => 'Halaman Penutup',
));

//
// Class: SurveyAnswer
//

Dict::Add('ID ID', 'Indonesian', 'Indonesian', array(
	'Class:SurveyAnswer' => 'JawabanSurvei',
	'Class:SurveyAnswer+' => '',
	'Class:SurveyAnswer/Attribute:survey_target_id' => 'Id target survei',
	'Class:SurveyAnswer/Attribute:survey_target_id+' => '',
	'Class:SurveyAnswer/Attribute:question_id' => 'Id pertanyaan',
	'Class:SurveyAnswer/Attribute:question_id+' => '',
	'Class:SurveyAnswer/Attribute:question_title' => 'Judul pertanyaan',
	'Class:SurveyAnswer/Attribute:question_title+' => '',
	'Class:SurveyAnswer/Attribute:question_description' => 'Deskripsi pertanyaan',
	'Class:SurveyAnswer/Attribute:question_description+' => '',
	'Class:SurveyAnswer/Attribute:contact_id' => 'Id kontak',
	'Class:SurveyAnswer/Attribute:contact_id+' => '',
	'Class:SurveyAnswer/Attribute:contact_name' => 'Nama kontak',
	'Class:SurveyAnswer/Attribute:contact_name+' => '',
	'Class:SurveyAnswer/Attribute:org_id' => 'Id organisasi',
	'Class:SurveyAnswer/Attribute:org_id+' => '',
	'Class:SurveyAnswer/Attribute:org_name' => 'Nama organisasi',
	'Class:SurveyAnswer/Attribute:org_name+' => '',
	'Class:SurveyAnswer/Attribute:value' => 'Nilai',
	'Class:SurveyAnswer/Attribute:value+' => '',
	'Class:SurveyAnswer/Attribute:question_id_finalclass_recall' => 'Pemanggilan kembali kelas akhir id pertanyaan',
	'Class:SurveyAnswer/Attribute:question_id_finalclass_recall+' => '',
	'Class:SurveyAnswer/Attribute:contact_id_obsolescence_flag' => 'Flag keusangan id kontak',
	'Class:SurveyAnswer/Attribute:contact_id_obsolescence_flag+' => '',
	'Class:SurveyAnswer/Attribute:org_id_obsolescence_flag' => 'Flag keusangan id organisasi',
	'Class:SurveyAnswer/Attribute:org_id_obsolescence_flag+' => '',
));

//
// Class: Quizz
//

Dict::Add('ID ID', 'Indonesian', 'Indonesian', array(
	'Class:Quizz/Attribute:language/Value:Brazilian (Brazilian)' => 'Brazil (Brazilian)',
	'Class:Quizz/Attribute:language/Value:Brazilian (Brazilian)+' => '',
	'Class:Quizz/Attribute:language/Value:Hungarian (Magyar)' => 'Hungaria (Magyar)',
	'Class:Quizz/Attribute:language/Value:Hungarian (Magyar)+' => '',
	'Class:Quizz/Attribute:language/Value:Chinese (简体中文)' => 'Cina (简体中文)',
	'Class:Quizz/Attribute:language/Value:Chinese (简体中文)+' => '',
	'Class:Quizz/Attribute:language/Value:Dutch (Nederlands)' => 'Belanda (Nederlands)',
	'Class:Quizz/Attribute:language/Value:Dutch (Nederlands)+' => '',
	'Class:Quizz/Attribute:language/Value:English (English)' => 'Inggris (English)',
	'Class:Quizz/Attribute:language/Value:English (English)+' => '',
	'Class:Quizz/Attribute:language/Value:German (Deutsch)' => 'Jerman (Deutsch)',
	'Class:Quizz/Attribute:language/Value:German (Deutsch)+' => '',
	'Class:Quizz/Attribute:language/Value:Russian (Русский)' => 'Rusia (Русский)',
	'Class:Quizz/Attribute:language/Value:Russian (Русский)+' => '',
	'Class:Quizz/Attribute:language/Value:Spanish (Español, Castellaño)' => 'Spanyol (Español, Castellaño)',
	'Class:Quizz/Attribute:language/Value:Spanish (Español, Castellaño)+' => '',
	'Class:Quizz/Attribute:language/Value:French (Français)' => 'Perancis (Français)',
	'Class:Quizz/Attribute:language/Value:French (Français)+' => '',
	'Class:Quizz/Attribute:language/Value:Japanese (日本語)' => 'Jepang (日本語)',
	'Class:Quizz/Attribute:language/Value:Japanese (日本語)+' => '',
	'Class:Quizz/Attribute:language/Value:Turkish (Türkçe)' => 'Turki (Türkçe)',
	'Class:Quizz/Attribute:language/Value:Turkish (Türkçe)+' => '',
	'Class:Quizz/Attribute:language/Value:Danish (Dansk)' => 'Denmark (Dansk)',
	'Class:Quizz/Attribute:language/Value:Danish (Dansk)+' => '',
	'Class:Quizz/Attribute:language/Value:Czech (Čeština)' => 'Ceko (Čeština)',
	'Class:Quizz/Attribute:language/Value:Czech (Čeština)+' => '',
	'Class:Quizz/Attribute:language/Value:Italian (Italiano)' => 'Italia (Italiano)',
	'Class:Quizz/Attribute:language/Value:Italian (Italiano)+' => '',
	'Class:Quizz/Attribute:language/Value:Indonesian (Bahasa Indonesia)' => 'Indonesia (Bahasa Indonesia)',
	'Class:Quizz/Attribute:language/Value:Indonesian (Bahasa Indonesia)+' => '',
));

//
// Class: QuizzElement
//

Dict::Add('ID ID', 'Indonesian', 'Indonesian', array(
	'Class:QuizzElement/Attribute:mandatory/Value:yes' => 'Ya',
	'Class:QuizzElement/Attribute:mandatory/Value:yes+' => '',
	'Class:QuizzElement/Attribute:mandatory/Value:no' => 'Tidak',
	'Class:QuizzElement/Attribute:mandatory/Value:no+' => '',
));

//
// Class: QuizzScaleQuestion
//

Dict::Add('ID ID', 'Indonesian', 'Indonesian', array(
	'Class:QuizzScaleQuestion/Attribute:scale_values' => 'Nilai skala',
	'Class:QuizzScaleQuestion/Attribute:scale_values+' => '',
));

//
// Class: Survey
//

Dict::Add('ID ID', 'Indonesian', 'Indonesian', array(
	'Class:Survey/Attribute:email_on_completion/Value:yes' => 'Ya',
	'Class:Survey/Attribute:email_on_completion/Value:yes+' => '',
	'Class:Survey/Attribute:email_on_completion/Value:no' => 'Tidak',
	'Class:Survey/Attribute:email_on_completion/Value:no+' => '',
	'Class:Survey/Attribute:survey_target_answer_list' => 'Daftar jawaban target survei',
	'Class:Survey/Attribute:survey_target_answer_list+' => '',
	'Class:Survey/Attribute:on_behalf_of_finalclass_recall' => 'Pemanggilan kembali kelas akhir atas nama',
	'Class:Survey/Attribute:on_behalf_of_finalclass_recall+' => '',
	'Class:Survey/Attribute:on_behalf_of_obsolescence_flag' => 'Flag keusangan atas nama',
	'Class:Survey/Attribute:on_behalf_of_obsolescence_flag+' => '',
));

//
// Class: SurveyTarget
//

Dict::Add('ID ID', 'Indonesian', 'Indonesian', array(
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall' => 'Pemanggilan kembali kelas akhir id kontak',
	'Class:SurveyTarget/Attribute:contact_id_finalclass_recall+' => '',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag' => 'Flag keusangan id kontak',
	'Class:SurveyTarget/Attribute:contact_id_obsolescence_flag+' => '',
));

//
// Class: SurveyTargetAnswer
//

Dict::Add('ID ID', 'Indonesian', 'Indonesian', array(
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall' => 'Pemanggilan kembali kelas akhir id kontak',
	'Class:SurveyTargetAnswer/Attribute:contact_id_finalclass_recall+' => '',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag' => 'Flag keusangan id kontak',
	'Class:SurveyTargetAnswer/Attribute:contact_id_obsolescence_flag+' => '',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag' => 'Flag keusangan id organisasi',
	'Class:SurveyTargetAnswer/Attribute:org_id_obsolescence_flag+' => '',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall' => 'Pemanggilan kembali kelas akhir id pertanyaan terakhir',
	'Class:SurveyTargetAnswer/Attribute:last_question_id_finalclass_recall+' => '',
));