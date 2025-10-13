<?php

declare(strict_types=1);

use Cpsit\CpsitProposal\Configuration\SettingsInterface;
use Cpsit\CpsitProposal\Controller\ProposalAppController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    SettingsInterface::NAME,
    SettingsInterface::PLUGIN_APP,
    [ProposalAppController::class => 'app'],
    [],
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
);
