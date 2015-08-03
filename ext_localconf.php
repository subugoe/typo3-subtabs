<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Erlaubte Controller/Actions
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Subugoe.' . $_EXTKEY,
    'Tabs',
    [
        'Tab' => 'list',
    ]
);

// Ausgabe der JSON Daten als eigenes Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Subugoe.' . $_EXTKEY,
    'Synonyme',
    [
        'Tab' => 'json'
    ]
);

// Scheduler zum abrufen und speichern der Json Dateien
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Suguboe\\Subtabs\\Service\\WritejsonfileTask'] = [
    'extension' => $_EXTKEY,
    'title' => 'Tabdataparser',
    'description' => 'Parsen eines dynamisch erstellten JSON in eine Datei'
];
