<?php

declare(strict_types=1);

/*
 * This file is part of the cpsit_proposal project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Domain\Model\Dto;

class ProposalDemand
{
    protected string $identifier = '';
    protected int $id = 0;
    protected array $idList = [];
    protected array $pageIds = [];
    protected array $status = [];
    protected int $limit = 0;

    protected string $order = 'crdate desc';

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdList(): array
    {
        return $this->idList;
    }

    public function setIdList(array $idList): void
    {
        $this->idList = $idList;
    }

    public function getPageIds(): array
    {
        return $this->pageIds;
    }

    public function setPageIds(array $pageIds): void
    {
        $this->pageIds = $pageIds;
    }

    public function getStatus(): array
    {
        return $this->status;
    }

    public function setStatus(array $status): void
    {
        $this->status = $status;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function setOrder(string $order): void
    {
        $this->order = $order;
    }
}
