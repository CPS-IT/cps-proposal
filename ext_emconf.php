<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'cpsit_proposal',
    'description' => 'Api to send and edit records proposal',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-13.4.99',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Cpsit\\CpsitProposal\\' => 'Classes/',
        ],
    ],
];
