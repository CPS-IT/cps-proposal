<?php

declare(strict_types=1);

/*
 * This file is part of the cpsit_proposal project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Domain\Repository;

use Cpsit\CpsitProposal\Domain\Model\Dto\ProposalDemand;
use Cpsit\CpsitProposal\Domain\Model\Proposal;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Qom\ConstraintInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class ProposalRepository extends Repository
{
    protected $defaultOrderings = [
        Proposal::FIELD_TSTAMP => QueryInterface::ORDER_DESCENDING,
        Proposal::FIELD_CRDATE => QueryInterface::ORDER_DESCENDING,
    ];

    public function initializeObject(): void
    {
        /** @var QuerySettingsInterface $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        // Show comments from all pages
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    public function findOneByUuid(string $uuid): ?object
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(false);
        $query->getQuerySettings()->setLanguageOverlayMode(true);

        $result = $query->matching(
            $query->equals(Proposal::FIELD_UUID, $uuid)
        )
            ->setLimit(1)
            ->execute();

        if ($result instanceof QueryResultInterface) {
            return $result->getFirst();
        }
        if (is_array($result)) {
            return $result[0] ?? null;
        }
        return null;
    }

    public function findDemanded(ProposalDemand $demand): QueryResultInterface
    {
        $query = $this->createQuery();
        $constraints = [];

        if (!empty($demand->getPageIds())) {
            $querySettings = $query->getQuerySettings();
            $querySettings->setRespectStoragePage(true)
                ->setStoragePageIds($demand->getPageIds());
            $query->setQuerySettings($querySettings);
        }

        if (!empty($demand->getLimit())) {
            $query->setLimit($demand->getLimit());
        }

        if (!empty($demand->getOrder())) {
            $orderings = $this->buildOrderingFromString($demand->getOrder());
            $query->setOrderings($orderings);
        }

        if (!empty($demand->getIdList())) {
            $constraints[] = $query->in(Proposal::FIELD_UID, $demand->getIdList());
        }

        if (!empty($demand->getStatus())) {
            $constraints[] = $query->in(
                Proposal::FIELD_STATUS,
                $demand->getStatus()
            );
        }

        if (!empty($demand->getId())) {
            $constraints[] = $query->equals(Proposal::FIELD_UID, $demand->getId());
        }

        if (!empty($demand->getIdentifier())) {
            $constraints[] = $query->equals(Proposal::FIELD_IDENTIFIER, $demand->getIdentifier());
        }

        if (!empty($constraints)) {
            $query->matching(
                $query->logicalAnd(...$constraints)
            );
        }

        return $query->execute();
    }

    protected function buildOrderingFromString(string $ordering = ''): array
    {
        $orderings = [];
        $orderList = GeneralUtility::trimExplode(',', $ordering, true);
        foreach ($orderList as $orderItem) {
            [$orderField, $ascDesc] = GeneralUtility::trimExplode(
                ' ',
                $orderItem,
                true
            );
            // count == 1 means that no direction is given
            if ($ascDesc) {
                $orderings[$orderField] = ((strtolower($ascDesc) === 'desc') ?
                    QueryInterface::ORDER_DESCENDING :
                    QueryInterface::ORDER_ASCENDING);
            } else {
                $orderings[$orderField] = QueryInterface::ORDER_ASCENDING;
            }
        }
        return $orderings;
    }

    public function findProposalsByTimeAndStatus(int $tstamp, int $status): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
            ->setRespectStoragePage(false)
            ->setRespectSysLanguage(false)
            ->setIgnoreEnableFields(true);

        $constraints = [
            $query->lessThan('tstamp', $tstamp),
            $query->equals('status', $status),
            $query->equals('deleted', 0),
        ];

        $query->matching($query->logicalAnd(...$constraints));
        return $query->execute();
    }

    protected function buildPropertyContainsConstraint(
        QueryInterface $query,
        string $fieldName,
        array $fieldValues,
        bool $logicalOr = true
    ): ?ConstraintInterface {
        $propertyConstraints = null;
        foreach ($fieldValues as $value) {
            $propertyConstraints[] = $query->contains($fieldName, $value);
        }
        if (!empty($propertyConstraints)) {
            if ($logicalOr) {
                $propertyConstraints = $query->logicalOr($propertyConstraints);
            }
            if (!$logicalOr) {
                $propertyConstraints = $query->logicalAnd($propertyConstraints);
            }
        }
        return $propertyConstraints;
    }
}
