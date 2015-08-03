<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_subtabs_domain_model_fach'] = array(
    'ctrl' => $TCA['tx_subtabs_domain_model_fach']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, titel, seite ,mitarbeiter_liste,tag_liste',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, titel, seite,mitarbeiter_liste, tag_liste,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
                'foreign_table' => 'tx_subtabs_domain_model_fach',
                'foreign_table_where' => 'AND tx_subtabs_domain_model_fach.pid=###CURRENT_PID### AND tx_subtabs_domain_model_fach.sys_language_uid IN (-1,0)',
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
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_fach.titel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'seite' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_fach.seite',
            'config' => array(
                'type' => 'input',
                'size' => '15',
                'max' => '255',
                'checkbox' => '',
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
        'mitarbeiter_liste' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_fach.mitarbeiter_liste',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tt_address',
                'foreign_table_where' => ' ORDER BY tt_address.last_name',
                'minitems' => 0,
                'maxitems' => 50,
                'MM' => 'tx_subtabs_domain_model_fach_tt_address_mm',
                'size' => 5
            ),
        ),
        'tag_liste' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_fach.tag_liste',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_subtabs_domain_model_tags',
                'foreign_field' => 'fach',
                'maxitems' => 9999,
                'appearance' => array(
                    'collapse' => 1,
                    'levelLinksPosition' => 'both',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        'faecher' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
    ),
);
