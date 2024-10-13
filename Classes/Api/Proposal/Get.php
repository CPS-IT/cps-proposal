<?php

declare(strict_types=1);

/*
 * This file is part of the cpsit-proposal project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Api\Proposal;

use Cpsit\CpsitProposal\Domain\Repository\ProposalRepository;
use Nng\Nnrestapi\Annotations as Api;
use Nng\Nnrestapi\Api\AbstractApi;
use TYPO3\CMS\Core\Http\Response;

/**
 * Get proposal record
 *
 * @Api\Endpoint
 */
class Get extends AbstractApi
{
    public const UUID_ARGUMENT = 'id';

    public function __construct(
        private readonly ProposalRepository $proposalRepository
    ) {}

    /**
     * Call via GET-request with an uuid:
     *
     * Example:
     *
     * https://www.mywebsite.com/api/proposal/01926e15-1adc-71b5-98be-3f585ded5410
     *
     * ### Response:
     *
     * ```
     * {
     *   "code": 200,
     *   "message": "success",
     *   "data": {
     *     "email": "nix@foo.org",
     *     "identifier": "any-string",
     *     "pid": 1053,
     *     "appPid": 1054,
     *     "proposal": "{json:payload}",
     *     "record": "",
     *     "requestLog": "{json:payload}",
     *     "status": 1,
     *     "uid": 4,
     *     "uuid": "01926e15-1adc-71b5-98be-3f585ded5410"
     *   }
     * }
     * ```
     *
     * @Api\Route("GET /proposal/{id}")
     * @Api\Access("public")
     * @Api\Localize
     * @return Response
     */
    public function getIndexAction(): Response
    {
        if (!$this->isRequestValid()) {
            // Return an `invalid parameters` (422) Response
            return $this->response->invalid(
                'Invalid parameters for proposal GET.',
                '1728420636'
            );
        }

        $uuid = $this->request->getArguments()[static::UUID_ARGUMENT];

        $proposal = $this->proposalRepository->findOneByUuid($uuid);

        if (empty($proposal)) {
            // Return a `not found` (404) Response
            return $this->response->notFound(
                'Proposal record not found',
                '1728420655'
            );
        }

        return $this->response
            ->setMessage('success')
            ->setStatus(200)
            ->setBody([
                'code' => $this->response->getStatus(),
                'message' => $this->response->getMessage(),
                'data' => $proposal,
            ])
            ->render();
    }

    protected function isRequestValid(): bool
    {
        $uuid = $this->request->getArguments()[static::UUID_ARGUMENT] ?? null;

        if (!$uuid) {
            return false;
        }

        return true;
    }
}
