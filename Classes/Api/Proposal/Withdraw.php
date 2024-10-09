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

use Cpsit\CpsitProposal\Domain\Model\Proposal;
use Cpsit\CpsitProposal\Domain\Repository\ProposalRepository;
use Cpsit\CpsitProposal\Event\ProposalPutAfterWithdrawEvent;
use Cpsit\CpsitProposal\Helper\ProposalFromRequestPayload;
use Nng\Nnhelpers\Utilities\Db;
use Nng\Nnrestapi\Annotations as Api;
use Nng\Nnrestapi\Api\AbstractApi;
use Psr\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Core\Http\Response;

/**
 * Withdraw a proposal
 *
 * @Api\Endpoint
 */
class Withdraw extends AbstractApi
{
    public const UUID_ARGUMENT = 'id';

    public function __construct(
        private readonly ProposalRepository $proposalRepository,
        private readonly Db $db,
        private readonly ProposalFromRequestPayload $proposalFromRequestPayload,
        private readonly EventDispatcherInterface $eventDispatcher
    ) {}

    /**
     * Call via PUT-request with an uuid:
     *
     * Example:
     *
     * `https://www.mywebsite.com/api/proposal/withdraw/01926e15-1adc-71b5-98be-3f585ded5410`
     *
     *
     * ### Response:
     *
     * {
     * "code": 202,
     * "message": "success",
     * "data": {
     *   "email": "nix@foo.org",
     *   "identifier": "any-string",
     *   "pid": 1053,
     *   "proposal": {"json":"payload"}",
     *   "record": "",
     *   "requestLog": "{"json":"data"}",
     *   "status": 1,
     *   "uid": 4,
     *   "uuid": "01926e15-1adc-71b5-98be-3f585ded5410"
     * }
     * }
     *
     * @Api\Route("PUT /proposal/withdraw/{id}")
     * @Api\Access("public")
     * @Api\Localize
     * @return Response
     */
    public function putIndexAction(): Response
    {
        if (!$this->isRequestValid()) {
            // Return an `invalid parameters` (422) Response
            return $this->response->invalid(
                'Invalid proposal withdraw PUT request.',
                '1728485797'
            );
        }

        $uuid = $this->request->getArguments()[static::UUID_ARGUMENT];

        $proposal = $this->proposalRepository->findOneByUuid($uuid);

        if (!$proposal instanceof Proposal) {
            // Return a `not found` (404) Response
            return $this->response->error(
                400,
                'Proposal record could not be found for uuid ' . $uuid,
                '1728485808'
            );
        }

        $this->proposalFromRequestPayload->withdraw($proposal, $this->request);
        $this->db->update($proposal);

        $this->response
            ->setMessage('success')
            ->setStatus(200);

        // Event dispatch after update
        $this->eventDispatcher->dispatch(
            new ProposalPutAfterWithdrawEvent(
                $proposal,
                $this->response,
                $this->request
            )
        );

        return $this->response->setBody([
            'code' => $this->response->getStatus(),
            'message' => $this->response->getMessage(),
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
