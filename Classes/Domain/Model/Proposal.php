<?php

declare(strict_types=1);

/*
 * This file is part of the cpsit_proposal project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Domain\Model;

use Cpsit\CpsitProposal\Type\ProposalStatus;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Proposal extends AbstractEntity
{
    public const TABLE_NAME = 'tx_cpsitproposal_domain_model_proposal';
    public const FIELD_UID = 'uid';
    public const FIELD_UUID = 'uuid';
    public const FIELD_STATUS = 'status';
    public const FIELD_CRDATE = 'crdate';
    public const FIELD_TSTAMP = 'tstamp';
    public const FIELD_IDENTIFIER = 'identifier';

    protected string $uuid = '';
    protected string $email = '';
    protected string $proposal = '';
    protected string $record = '';
    protected string $identifier = '';
    protected string $requestLog = '';
    protected int $status = 0;
    protected int $appPid = 0;
    protected bool $hidden = false;

    protected ?\DateTime $tstamp = null;
    protected ?\DateTime $crdate = null;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getProposal(): string
    {
        return $this->proposal;
    }

    public function setProposal(string $proposal): void
    {
        $this->proposal = $proposal;
    }

    public function getAppPid(): int
    {
        return $this->appPid;
    }

    public function setAppPid(int $appPid): void
    {
        $this->appPid = $appPid;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getStatusIconIdentifier(): string
    {
        $status = ProposalStatus::tryFrom($this->status) ?? ProposalStatus::Undefined;
        return ProposalStatus::getIconIdentifier($status);
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getRecord(): string
    {
        return $this->record;
    }

    public function getRecordFromDbInBackend(): ?array
    {
        if (empty($this->getRecord())) {
            return null;
        }

        [$table, $uid] = BackendUtility::splitTable_Uid($this->getRecord());
        return BackendUtility::getRecord($table, $uid);
    }

    public function setRecord(string $record): void
    {
        $this->record = $record;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * Internal request log to this proposal
     *
     * @return string
     * @internal
     */
    public function _getRequestLog(): string
    {
        return $this->requestLog;
    }

    public function setRequestLog(string $requestLog): void
    {
        $this->requestLog = $requestLog;
    }

    public function getHidden(): bool
    {
        return $this->hidden;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    public function getTstamp(): ?\DateTime
    {
        return $this->tstamp;
    }

    public function setTstamp(?\DateTime $tstamp): void
    {
        $this->tstamp = $tstamp;
    }

    public function getCrdate(): ?\DateTime
    {
        return $this->crdate;
    }

    public function setCrdate(?\DateTime $crdate): void
    {
        $this->crdate = $crdate;
    }
}
