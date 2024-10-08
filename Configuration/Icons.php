<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    // Proposal
    'icon-proposal-idea' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cpsit_proposal/Resources/Public/Icons/icon-proposal-idea.svg',
    ],
    // Page module
    'cps-proposal-page-tree-module' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cpsit_proposal/Resources/Public/Icons/page-tree-module.svg',
    ],
];
