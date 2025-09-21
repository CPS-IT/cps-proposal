<?php

defined('TYPO3') or die();

use Cpsit\CpsitProposal\Configuration\SettingsInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$pluginSignature = ExtensionUtility::registerPlugin(
    SettingsInterface::NAME,
    SettingsInterface::PLUGIN_APP,
    'LLL:EXT:cpsit_proposal/Resources/Private/Language/locallang_be.xlf:app.plugin.title',
    'icon-proposal-idea',
    'plugins',
);
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,pi_flexform,',
    $pluginSignature,
    'after:palette:headers'
);
ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:cpsit_proposal/Configuration/FlexForms/AppFlexForm.xml',
    $pluginSignature
);
