<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_subtabs_domain_model_kataloge'] = array(
    'ctrl' => $TCA['tx_subtabs_domain_model_kataloge']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, titel, katalog_liste,seiten_liste',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, titel, katalog_liste,seiten_liste,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
                'foreign_table' => 'tx_subtabs_domain_model_kataloge',
                'foreign_table_where' => 'AND tx_subtabs_domain_model_kataloge.pid=###CURRENT_PID### AND tx_subtabs_domain_model_kataloge.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
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
                    'lower' => mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'))
                ),
            ),
        ),
        'titel' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_kataloge.titel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'katalog_liste' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_kataloge.katalog_liste',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_subtabs_domain_model_katalog',
                'foreign_field' => 'kataloge',
                'foreign_sortby' => 'sorting',
                'maxitems' => 9999,
                'appearance' => array(
                    'useSortable' => 1,
                    'collapseAll' => 1,
                    'collapse' => 1,
                    'levelLinksPosition' => 'both',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        'seiten_liste' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_kataloge.seiten_liste',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'maxitems' => 25,
                'size' => 5
            ),
        ),
    ),
);
