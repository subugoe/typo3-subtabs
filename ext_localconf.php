<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Erlaubte Controller/Actions
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Subugoe.' . $_EXTKEY, // The extension name (in UpperCamelCase) or the extension key (in lower_underscore)
		'Tabs', // A unique name of the plugin in UpperCamelCase
		array( // An array holding the controller-action-combinations that are accessible
				'Tab' => 'list',
				'Katalog' => 'list, show',
				'Faecher' => 'list, suche',
				'Webseite' => 'list'
		)
);

// Ausgabe der JSON Daten als eigenes Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Subugoe.' . $_EXTKEY,
		'Synonyme',
		array(
				'Tab' => 'json'
		)
);

// Ajax als eigenes Plugin - nutzung als pageType
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Subugoe.' . $_EXTKEY,
		'Ajax',
		array(
				'Ajax' => 'index'
		)
);

// Scheduler zum abrufen und speichern der Json Dateien
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Suguboe\\Subtabs\\Service\\WritejsonfileTask'] = array(
		'extension' => $_EXTKEY,
		'title' => 'Tabdataparser',
		'description' => 'Parsen eines dynamisch erstellten JSON in eine Datei'
);

// Register cache subtabs_cache'
if (!is_array($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['subtabs_cache'])) {
	$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['subtabs_cache'] = array();
}
$TYPO3_CONF_VARS['FE']['eID_include'][$_EXTKEY . '_subjects'] = 'EXT:' . $_EXTKEY . '/Resources/Private/Ajax/FaecherSammlungen.php';
