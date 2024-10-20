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
    // Proposal status icons

    'icon-proposal-status-approved' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cpsit_proposal/Resources/Public/Icons/icon-proposal-status-approved.svg',
    ],
    'icon-proposal-status-edited' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cpsit_proposal/Resources/Public/Icons/icon-proposal-status-edited.svg',
    ],
    'icon-proposal-status-error' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cpsit_proposal/Resources/Public/Icons/icon-proposal-status-error.svg',
    ],
    'icon-proposal-status-new' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cpsit_proposal/Resources/Public/Icons/icon-proposal-status-new.svg',
    ],
    'icon-proposal-status-rejected' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cpsit_proposal/Resources/Public/Icons/icon-proposal-status-rejected.svg',
    ],
    'icon-proposal-status-undefined' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cpsit_proposal/Resources/Public/Icons/icon-proposal-status-undefined.svg',
    ],
    'icon-proposal-status-withdraw' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cpsit_proposal/Resources/Public/Icons/icon-proposal-status-withdraw.svg',
    ],
];
