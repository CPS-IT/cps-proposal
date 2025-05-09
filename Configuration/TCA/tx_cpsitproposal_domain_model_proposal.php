<?php

defined('TYPO3') or die();

$ll = 'LLL:EXT:cpsit_proposal/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title' => $ll . 'tx_cpsitproposal_domain_model_proposal',
        'descriptionColumn' => 'notes',
        'label' => 'email',
        'label_alt' => 'type, uuid',
        'label_alt_force' => true,
        'prependAtCopy' => '',
        'hideAtCopy' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'origUid' => 't3_origuid',
        'editlock' => 'editlock',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource' => 'l10n_source',
        'sortby' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => 'EXT:cpsit_proposal/Resources/Public/Icons/icon-proposal-idea.svg',
        'searchFields' => 'uid, uuid, proposal, status, email, type, request_log',
    ],
    'columns' => [
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'group',
                'allowed' => 'tx_news_domain_model_news',
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0,
                'default' => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
            ],
        ],
        'cruser_id' => [
            'label' => 'cruser_id',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'pid' => [
            'label' => 'pid',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'crdate' => [
            'label' => 'crdate',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'tstamp' => [
            'label' => 'tstamp',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel',
            'config' => [
                'type' => 'datetime',
                'size' => 16,
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
            'config' => [
                'type' => 'datetime',
                'size' => 16,
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'editlock' => [
            'displayCond' => 'HIDE_FOR_NON_ADMINS',
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:editlock',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ],
        ],
        'uuid' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.uuid',
            'description' => $ll . 'tx_cpsitproposal_domain_model_proposal.uuid',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 100,
                'eval' => 'trim',
                'readOnly' => true,
            ],
        ],
        'email' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.email',
            'description' => $ll . 'tx_cpsitproposal_domain_model_proposal.email.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 100,
                'eval' => 'trim',
                'readOnly' => true,
            ],
        ],
        'proposal' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.proposal',
            'description' => $ll . 'tx_cpsitproposal_domain_model_proposal.proposal.description',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
                'readOnly' => true,
            ],
        ],

        'status' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.status',
            'description' => $ll . 'tx_cpsitproposal_domain_model_proposal.status.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => '0',
                'readOnly' => true,
                'items' => [
                    [
                        'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.status.0',
                        'value' => 0,
                    ],
                    [
                        'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.status.1',
                        'value' => 1,
                    ],
                    [
                        'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.status.2',
                        'value' => 2,
                    ],
                    [
                        'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.status.3',
                        'value' => 3,
                    ],
                    [
                        'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.status.4',
                        'value' => 4,
                    ],
                    [
                        'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.status.5',
                        'value' => 5,
                    ],
                    [
                        'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.status.6',
                        'value' => 6,
                    ],
                    [
                        'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.status.7',
                        'value' => 7,
                    ],
                ],
            ],
        ],
        'record' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.record',
            'config' => [
                'type' => 'group',
                'allowed' => '',
                'prepend_tname' => true,
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0,
                'hideSuggest' => true,
                'hideMoveIcons' => true,
                'readOnly' => true,
                'fieldControl' => [
                    'elementBrowser' => [
                        'disabled' => true,
                    ],
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => true,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            'default' => 0,
        ],
        'identifier' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.identifier',
            'description' => $ll . 'tx_cpsitproposal_domain_model_proposal.identifier.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'trim',
                'readOnly' => true,
            ],
        ],
        'request_log' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.request_log',
            'description' => $ll . 'tx_cpsitproposal_domain_model_proposal.request_log.description',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
                'readOnly' => true,
            ],
        ],
        'app_pid' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.app_pid',
            'description' => $ll . 'tx_cpsitproposal_domain_model_proposal.app_pid.description',
            'config' => [
                'type' => 'group',
                'allowed' => 'pages',
                'prepend_tname' => false,
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0,
                'hideMoveIcons' => true,
                'readOnly' => true,
                'fieldControl' => [
                    'addRecord' => [
                        'disabled' => true,
                    ],
                ],
            ],
            'default' => 0,
        ],
        'notes' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.description',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 30,
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'uid, uuid, proposal, record, status, email, identifier, app_pid, request_log,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,notes,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.extended,',
        ],
    ],
    'palettes' => [
        'hidden' => [
            'showitem' => '
                hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden
            ',
        ],
        'language' => [
            'showitem' => '
                sys_language_uid;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:sys_language_uid_formlabel,l18n_parent
            ',
        ],
        'access' => [
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access',
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel,
                --linebreak--,editlock
            ',
        ],
    ],
];
