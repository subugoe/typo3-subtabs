<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_subtabs_domain_model_katalog'] = [
    'ctrl' => $TCA['tx_subtabs_domain_model_katalog']['ctrl'],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, titel, url, suchparameter, direkt_link, direkt_link_titel, information, neues_fenster',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, titel, url, suchparameter, direkt_link, direkt_link_titel, information, neues_fenster,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.php:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_subtabs_domain_model_katalog',
                'foreign_table_where' => 'AND tx_subtabs_domain_model_katalog.pid=###CURRENT_PID### AND tx_subtabs_domain_model_katalog.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'max' => '255',
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => '10',
                'max' => '20',
                'eval' => 'datetime',
                'checkbox' => '0',
                'default' => '0',
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => '8',
                'max' => '20',
                'eval' => 'datetime',
                'checkbox' => '0',
                'default' => '0',
                'range' => [
                    'upper' => mktime(0, 0, 0, 12, 31, date('Y') + 10),
                    'lower' => mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'))
                ],
            ],
        ],
        'titel' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.titel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'url' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.url',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'eval' => 'trim',
                'wizards' => [
                    '_PADDING' => 2,
                    'link' => [
                        'type' => 'popup',
                        'title' => 'Link',
                        'icon' => 'link_popup.gif',
                        'module' => [
                            'name' => 'wizard_element_browser',
                            'urlParameters' => [
                                'mode' => 'wizard',
                                'act' => 'file'
                            ]
                        ],
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
                    ]
                ]
            ]
        ],
        'direkt_link' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.direkt_link',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'eval' => 'trim',
                'wizards' => [
                    '_PADDING' => 2,
                    'link' => [
                        'type' => 'popup',
                        'title' => 'Link',
                        'icon' => 'link_popup.gif',
                        'module' => [
                            'name' => 'wizard_element_browser',
                            'urlParameters' => [
                                'mode' => 'wizard',
                                'act' => 'file'
                            ]
                        ],
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
                    ]
                ]
            ]
        ],
        'direkt_link_titel' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.direktLinkTitel',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ],
        ],
        'suchparameter' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.suchparameter',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim'
            ],
        ],
        'information' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.information',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ],
        ],
        'neues_fenster' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subtabs/Resources/Private/Language/locallang_db.xml:tx_subtabs_domain_model_katalog.neues_fenster',
            'config' => [
                'type' => 'check',
                'default' => 0
            ],
        ],
        'kataloge' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
