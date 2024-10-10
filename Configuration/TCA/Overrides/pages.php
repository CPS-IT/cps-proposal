<?php

defined('TYPO3_MODE') or die();

// Override page icon
$GLOBALS['TCA']['pages']['columns']['module']['config']['items'][] = [
    0 => 'LLL:EXT:cpsit_proposal/Resources/Private/Language/locallang_db.xlf:tx_cpsitproposal_domain_model_proposal',
    1 => 'cpsit_proposal',
    2 => 'icon-proposal-idea',
];

$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['contains-cpsit_proposal'] = 'cps-proposal-page-tree-module';
$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['contains-cpsit-proposal'] = 'cps-proposal-page-tree-module';
$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['contains-cpsitproposal'] = 'cps-proposal-page-tree-module';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'cpsit_proposal',
    'Configuration/TSconfig/AllowedNewTables.typoscript',
    'EXT:tt_address :: Restrict pages to tt_address records'
);
