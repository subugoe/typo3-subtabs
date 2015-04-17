<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_subtabs_domain_model_katalog'] = array(
	'ctrl' => $TCA['tx_subtabs_domain_model_katalog']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, titel, url, suchparameter, direkt_link, direkt_link_titel, information, neues_fenster',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, titel, url, suchparameter, direkt_link, direkt_link_titel, information, neues_fenster,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_subtabs_domain_model_katalog',
				'foreign_table_where' => 'AND tx_subtabs_domain_model_katalog.pid=###CURRENT_PID### AND tx_subtabs_domain_model_katalog.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' =>array(
				'type' =>'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
			'type' => 'input',
			'size' => '30',
			'max' => '255',
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => '0',
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => '0',
				'range' => array(
					'upper' => mktime(0, 0, 0, 12, 31, date('Y') + 10),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				),
			),
		),
		'titel' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.titel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'url' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.url',
			'config' => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'wizards' => array(
					'_PADDING' => 2,
					'link' => array(
						'type' => 'popup',
						'title' => 'Link',
						'icon' => 'link_popup.gif',
						'script' => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'direkt_link' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.direkt_link',
			'config' => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'wizards' => array(
					'_PADDING' => 2,
					'link' => array(
						'type' => 'popup',
						'title' => 'Link',
						'icon' => 'link_popup.gif',
						'script' => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'direkt_link_titel' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.direktLinkTitel',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'suchparameter' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.suchparameter',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
			),
		),
		'information' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.information',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'neues_fenster' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.neues_fenster',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'kataloge' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
