<?php

declare(strict_types=1);

use Cpsit\CpsitProposal\Configuration\SettingsInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

(static function (): void {
    $pluginSignature = strtolower(SettingsInterface::NAME) . '_' . strtolower(SettingsInterface::PLUGIN_APP);
    ExtensionUtility::registerPlugin(
        SettingsInterface::NAME,
        SettingsInterface::PLUGIN_APP,
        'LLL:EXT:cpsit_proposal/Resources/Private/Language/locallang_be.xlf:app.plugin.title',
        'icon-proposal-idea',
        'plugins',
    );

    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key,pages,recursive';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
    ExtensionManagementUtility::addPiFlexFormValue(
        $pluginSignature,
        'FILE:EXT:cpsit_proposal/Configuration/FlexForms/AppFlexForm.xml'
    );
})();
