<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('Subugoe.' . $_EXTKEY, 'Tabs', 'Tabs');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('Subugoe.' . $_EXTKEY, 'Ajax', 'Ajaxtabs Neu');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Tabs');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_subtabs_domain_model_faecher');
$TCA['tx_subtabs_domain_model_faecher'] = array(
		'ctrl' => array(
				'title' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_faecher',
				'label' => 'titel',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'dividers2tabs' => TRUE,
				'versioningWS' => 2,
				'versioning_followPages' => TRUE,
				'origUid' => 't3_origuid',
				'languageField' => 'sys_language_uid',
				'transOrigPointerField' => 'l10n_parent',
				'transOrigDiffSourceField' => 'l10n_diffsource',
				'delete' => 'deleted',
				'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
				),
				'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Faecher.php',
				'searchFields' => 'titel',
				'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_subtabs_domain_model_faecher.gif'
		),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_subtabs_domain_model_kataloge');
$TCA['tx_subtabs_domain_model_kataloge'] = array(
		'ctrl' => array(
				'title' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_kataloge',
				'label' => 'titel',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'dividers2tabs' => TRUE,
				'versioningWS' => 2,
				'versioning_followPages' => TRUE,
				'origUid' => 't3_origuid',
				'languageField' => 'sys_language_uid',
				'transOrigPointerField' => 'l10n_parent',
				'transOrigDiffSourceField' => 'l10n_diffsource',
				'delete' => 'deleted',
				'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
				),
				'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Kataloge.php',
				'searchFields' => 'titel',
				'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_subtabs_domain_model_kataloge.gif'
		),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_subtabs_domain_model_webseite');
$TCA['tx_subtabs_domain_model_webseite'] = array(
		'ctrl' => array(
				'title' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_webseite',
				'label' => 'uid',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'dividers2tabs' => TRUE,
				'versioningWS' => 2,
				'versioning_followPages' => TRUE,
				'origUid' => 't3_origuid',
				'languageField' => 'sys_language_uid',
				'transOrigPointerField' => 'l10n_parent',
				'transOrigDiffSourceField' => 'l10n_diffsource',
				'delete' => 'deleted',
				'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
				),
				'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Webseite.php',
				'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_subtabs_domain_model_webseite.gif'
		),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_subtabs_domain_model_katalog');
$TCA['tx_subtabs_domain_model_katalog'] = array(
		'ctrl' => array(
				'title' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog',
				'label' => 'titel',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'dividers2tabs' => TRUE,
				'versioningWS' => 2,
				'versioning_followPages' => TRUE,
				'origUid' => 't3_origuid',
				'languageField' => 'sys_language_uid',
				'transOrigPointerField' => 'l10n_parent',
				'transOrigDiffSourceField' => 'l10n_diffsource',
				'delete' => 'deleted',
				'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
				),
				'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Katalog.php',
				'searchFields' => 'titel',
				'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_subtabs_domain_model_katalog.gif'
		),
);

$TCA['tx_subtabs_domain_model_fach'] = array(
		'ctrl' => array(
				'title' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_fach',
				'label' => 'titel',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'dividers2tabs' => TRUE,
				'versioningWS' => 2,
				'versioning_followPages' => TRUE,
				'origUid' => 't3_origuid',
				'languageField' => 'sys_language_uid',
				'transOrigPointerField' => 'l10n_parent',
				'transOrigDiffSourceField' => 'l10n_diffsource',
				'delete' => 'deleted',
				'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
				),
				'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Fach.php',
				'searchFields' => 'titel',
				'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_subtabs_domain_model_katalog.gif'
		),
);

//Tabelle fuer die Tags
$TCA['tx_subtabs_domain_model_tags'] = array(
		'ctrl' => array(
				'title' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_tags',
				'label' => 'tag',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'dividers2tabs' => TRUE,
				'versioningWS' => 2,
				'versioning_followPages' => TRUE,
				'origUid' => 't3_origuid',
				'languageField' => 'sys_language_uid',
				'transOrigPointerField' => 'l10n_parent',
				'transOrigDiffSourceField' => 'l10n_diffsource',
				'delete' => 'deleted',
				'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
				),
				'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Tags.php',
				'searchFields' => 'tag',
				'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_subtabs_domain_model_katalog.gif'
		),
);

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);

//TAB Flexform
$pluginSignature = strtolower($extensionName) . '_tabs';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_tabs.xml');

