<?php

declare(strict_types=1);

/*
 * This file is part of the cpsit-proposal project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class ProposalAppController extends ActionController
{
    public function appAction(): ResponseInterface
    {
        $this->prepareView();
        return $this->htmlResponse();
    }

    protected function prepareView(): void
    {
        /** @var Site $site */
        $site = $this->request->getAttribute('site');

        /** @var TypoScriptFrontendController $frontendController */
        $frontendController = $this->request->getAttribute('frontend.controller');

        $typo3Version = new Typo3Version();
        if ($typo3Version->getMajorVersion() > 11) {
            /** @var ContentObjectRenderer $contentObject */
            $contentObject = $this->request->getAttributes('currentContentObject');
        }

        if ($typo3Version->getMajorVersion() < 12) {
            /** @var ContentObjectRenderer $contentObject */
            $contentObject = $this->configurationManager->getContentObject();
        }

        $this->view->assign('contentObjectData', $this->configurationManager->getContentObject()->data);
        if (is_object($GLOBALS['TSFE'])) {
            $this->view->assign('pageData', $GLOBALS['TSFE']->page);
        }

        $this->view->assignMultiple(
            [
                'base' => $site->getConfiguration()['base'] ?? '',
                'page' => $frontendController->page,
                'contentObjectData' => $contentObject->data,
            ]
        );
    }
}
