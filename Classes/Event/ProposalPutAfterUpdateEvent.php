<?php

declare(strict_types=1);

/*
 * This file is part of the cpsit-proposal project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Event;

use Cpsit\CpsitProposal\Domain\Model\Proposal;
use Nng\Nnrestapi\Mvc\Response;
use Nng\Nnrestapi\Mvc\Request;

/**
 * Event for proposal after put request
 *
 * Add Extra logic like sending e-mail
 * Modify response
 */
class ProposalPutAfterUpdateEvent
{
    public function __construct(
        private Proposal $proposal,
        private Response $response,
        private readonly Request $request
    ) {
    }

    public function getProposal(): Proposal
    {
        return $this->proposal;
    }

    public function setProposal(Proposal $proposal): void
    {
        $this->proposal = $proposal;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
