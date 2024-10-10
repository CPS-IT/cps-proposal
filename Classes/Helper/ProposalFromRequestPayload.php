<?php

declare(strict_types=1);

/*
 * This file is part of the cpsit-proposal project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Helper;

use Cpsit\CpsitProposal\Domain\Model\Proposal;
use Cpsit\CpsitProposal\Type\ProposalStatus;
use Nng\Nnrestapi\Mvc\Request;
use Symfony\Component\Uid\Uuid;

final class ProposalFromRequestPayload
{
    public function __construct(
        protected RequestDataProvider $requestDataProvider
    ) {}

    public function create(Request $request): Proposal
    {
        $proposal = new Proposal();

        $proposal->setUuid(Uuid::v7()->toString());
        $proposal->setEmail($request->getBody()['email']);
        $proposal->setProposal($request->getRawBody());
        $proposal->setStatus(ProposalStatus::New->value);
        $proposal->setIdentifier($request->getBody()['identifier'] ?? 0);
        $proposal->setPid((int)$request->getBody()['pid'] ?? 0);
        $proposal->setAppPid((int)$request->getBody()['appPid'] ?? 0);
        $proposal->setRequestLog(
            json_encode($this->requestDataProvider->get($request))
        );

        return $proposal;
    }

    public function update(Proposal $proposal, Request $request): void
    {
        $proposal->setEmail($request->getBody()['email']);
        $proposal->setProposal($request->getRawBody());
        $proposal->setStatus(ProposalStatus::Edited->value);
        $proposal->setIdentifier($request->getBody()['identifier'] ?? 0);
        $proposal->setPid((int)$request->getBody()['pid'] ?? 0);
        $proposal->setAppPid((int)$request->getBody()['appPid'] ?? 0);

        // Prepend request log
        $requestLog = $this->updateProposalRequestLog(
            $request,
            (string)$proposal->_getRequestLog()
        );
        $proposal->setRequestLog($requestLog);
    }

    public function withdraw(Proposal $proposal, Request $request): void
    {
        $proposal->setStatus(ProposalStatus::Withdraw->value);

        // Prepend request log
        $requestLog = $this->updateProposalRequestLog(
            $request,
            (string)$proposal->_getRequestLog()
        );
        $proposal->setRequestLog($requestLog);
    }

    protected function updateProposalRequestLog(Request $request, string $log = ''): string
    {
        $log = json_decode($log, true);
        if (!is_array($log)) {
            $log = [
                0 => $this->requestDataProvider->get($request),
            ];
            return json_encode($log);
        }
        return json_encode([$this->requestDataProvider->get($request), ...$log]);
    }
}
