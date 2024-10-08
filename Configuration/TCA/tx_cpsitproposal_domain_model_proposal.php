<?php

defined('TYPO3_MODE') or die();

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
        'cruser_id' => 'cruser_id',
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
        'uuid' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.uuid',
            'description' => $ll . 'tx_cpsitproposal_domain_model_proposal.uuid',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 100,
                'eval' => 'trim',
            ]
        ],
        'email' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.email.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 100,
                'eval' => 'trim',
            ]
        ],
        'proposal' => [
            'exclude' => false,
            'label' => $ll . 'tx_cpsitproposal_domain_model_proposal.proposal',
            'description' => $ll . 'tx_cpsitproposal_domain_model_proposal.proposal.description',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
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
                'items' => [
                    [
                        $ll . 'tx_cpsitproposal_domain_model_proposal.status.0',
                        0,
                    ],
                    [
                        $ll . 'tx_cpsitproposal_domain_model_proposal.status.1',
                        1,
                    ],
                    [
                        $ll . 'tx_cpsitproposal_domain_model_proposal.status.2',
                        2,
                    ],
                    [
                        $ll . 'tx_cpsitproposal_domain_model_proposal.status.3',
                        3,
                    ],
                    [
                        $ll . 'tx_cpsitproposal_domain_model_proposal.status.4',
                        4,
                    ],
                    [
                        $ll . 'tx_cpsitproposal_domain_model_proposal.status.5',
                        5,
                    ],
                    [
                        $ll . 'tx_cpsitproposal_domain_model_proposal.status.6',
                        6,
                    ]
                ],
            ],
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
            'showitem' => 'uid, uuid, proposal, status, email, type, request_log,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.extended,'
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
    ]
];


