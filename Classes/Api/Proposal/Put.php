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
use Cpsit\CpsitProposal\Event\ProposalPutAfterUpdateEvent;
use Cpsit\CpsitProposal\Helper\ProposalFromRequestPayload;
use Nng\Nnhelpers\Utilities\Db;
use Nng\Nnrestapi\Annotations as Api;
use Nng\Nnrestapi\Api\AbstractApi;
use Psr\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Update a proposal
 *
 * @Api\Endpoint
 */
class Put extends AbstractApi
{
    public const UUID_ARGUMENT = 'id';
    public const REQUIRED_ARGUMENTS = ['email', 'identifier', 'pid'];

    public function __construct(
        private readonly ProposalRepository $proposalRepository,
        private readonly Db $db,
        private readonly ProposalFromRequestPayload $proposalFromRequestPayload,
        private readonly EventDispatcherInterface $eventDispatcher
    ) {}

    /**
     * Call via PUT-request with payload https://www.mywebsite.com/api/proposal/1
     * Required params: validationHash, email, identifier, pid
     * Example:
     *
     * `https://www.mywebsite.com/api/proposal/01926e15-1adc-71b5-98be-3f585ded5410`
     *
     * ### Proposal:
     *
     * ```
     * {
     * "validationHash": "8743b52063cd84097a65d1633f5c74f5",
     * "email": "nix@foo.org",
     * "identifier": "any-string-updated",
     * "pid": 1053,
     * "title": "A event proposal with title",
     * "teaser": "Teaser text for event proposal. The teaser must not  contain any html tags\n",
     * "datetime": "2017-07-21T17:00:00",
     * "text": "Do not miss this event! It will be awesome.",
     * "categories": "1,3,6",
     * "state": 13,
     * "language": "de"
     * }
     * ```
     *
     * ### Success:
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
     * @Api\Route("PUT /proposal/{id}")
     * @Api\Access("public")
     * @Api\Localize
     * @return Response
     */
    public function putIndexAction(): Response
    {
        if (!$this->isRequestValid()) {
            // Return an `invalid parameters` (422) Response
            return $this->response->invalid(
                'Invalid proposal PUT request.',
                '1728475423'
            );
        }

        $uuid = $this->request->getArguments()[static::UUID_ARGUMENT];

        $proposal = $this->proposalRepository->findOneByUuid($uuid);

        if (!$proposal instanceof Proposal) {
            // Return a `not found` (404) Response
            return $this->response->error(
                400,
                'Proposal record could not be found for uuid ' . $uuid,
                '1728475428'
            );
        }

        $this->proposalFromRequestPayload->update($proposal, $this->request);
        $this->db->update($proposal);

        $this->response
            ->setMessage('success')
            ->setStatus(202);

        // Event dispatch after update
        $this->eventDispatcher->dispatch(
            new ProposalPutAfterUpdateEvent(
                $proposal,
                $this->response,
                $this->request
            )
        );

        return $this->response->setBody([
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

        $payload = $this->request->getBody();

        foreach (self::REQUIRED_ARGUMENTS as $argument) {
            if (!isset($payload[$argument])) {
                return false;
            }
        }

        if (!GeneralUtility::validEmail($payload['email'] ?? null)
        ) {
            return false;
        }
        return true;
    }
}
