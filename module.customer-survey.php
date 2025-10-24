<?php

// Copyright (C) 2011 Combodo SARL
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'customer-survey/2.6.1',
	[
		// Identification
		//
		'label' => 'Customer Survey',
		'category' => 'business',

		// Setup
		//
		'dependencies' => [
			'itop-request-mgmt/3.2.0 || itop-structure/3.2.0',
		],
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => [
			'vendor/autoload.php',
			'main.customer-survey.php',
			'model.customer-survey.php',
		],
		'webservice' => [

		],
		'dictionary' => [
			'en.dict.customer-survey.php',
			'fr.dict.customer-survey.php',
		],
		'data.struct' => [
			// add your 'structure' definition XML files here,
		],
		'data.sample' => [
			// add your sample data XML files here,
		],

		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any

		// Default settings
		//
		'settings' => [
			// Module specific settings go here, if any
			'anonymous_survey' => false,
			'quiz_scale' => 'Very bad, Bad, Average, Good, Very good',
		],
	]
);
