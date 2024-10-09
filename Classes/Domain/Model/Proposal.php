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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Proposal extends AbstractEntity
{
    public const TABLE_NAME = 'tx_cpsitproposal_domain_model_proposal';
    public const FIELD_UUID = 'uuid';

    protected string $uuid = '';
    protected string $email = '';
    protected string $proposal = '';
    protected int $status = 0;
    protected string $record = '';
    protected string $identifier = '';
    protected string $requestLog = '';

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

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getRecord(): string
    {
        return $this->record;
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

    public function getRequestLog(): string
    {
        return $this->requestLog;
    }

    public function setRequestLog(string $requestLog): void
    {
        $this->requestLog = $requestLog;
    }
}
