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

final class CreateProposalFromPostRequest
{

    public function __construct(
        protected RequestDataProvider $requestDataProvider
    ) {
    }

    public function create(Request $request): Proposal
    {
        $proposal = new Proposal();

        $proposal->setUuid(Uuid::v7()->toString());
        $proposal->setEmail($request->getBody()['email']);
        $proposal->setProposal($request->getRawBody());
        $proposal->setStatus(ProposalStatus::New->value);
        $proposal->setIdentifier($request->getBody()['identifier'] ?? 0);
        $proposal->setPid((int)$request->getBody()['pid'] ?? 0);
        $proposal->setRequestLog(
            json_encode($this->requestDataProvider->get($request))
        );

        return $proposal;
    }
}