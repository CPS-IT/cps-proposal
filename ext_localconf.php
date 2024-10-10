<?php

declare(strict_types=1);

use Cpsit\CpsitProposal\Configuration\SettingsInterface;
use Cpsit\CpsitProposal\Controller\ProposalAppController;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    SettingsInterface::NAME,
    SettingsInterface::PLUGIN_APP,
    [ProposalAppController::class => 'app'],
);

$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
// Only include page.tsconfig if TYPO3 version is below 12 so that it is not imported twice.
if ($versionInformation->getMajorVersion() < 12) {
    ExtensionManagementUtility::addPageTSConfig('
      @import "EXT:cpsit_proposal/Configuration/page.tsconfig"
   ');
}
