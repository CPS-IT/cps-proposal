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
use Nng\Nnrestapi\Mvc\Request;
use Nng\Nnrestapi\Mvc\Response;

/**
 * Validation E-Mail
 *
 * Add Extra logic like sending e-mail
 * Modify response
 */
class ValidationEmailPostEvent
{
    public function __construct(
        private array $data,
        private Response $response,
        private readonly Request $request
    ) {}

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
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
