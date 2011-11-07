<?php
// Copyright (C) 2011 Combodo SARL
//


SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'combodo-customer-survey/1.0.0',
	array(
		// Identification
		//
		'label' => 'Customer Survey',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'model.combodo-customer-survey.php'
		),
		'webservice' => array(
			
		),
		'dictionary' => array(
			'en.dict.combodo-customer-survey.php',
			'fr.dict.combodo-customer-survey.php',
		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			// Module specific settings go here, if any
		),
	)
);


?>
