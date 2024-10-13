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
use Cpsit\CpsitProposal\Event\ProposalPostAfterInsertEvent;
use Cpsit\CpsitProposal\Helper\ProposalFromRequestPayload;
use Nng\Nnhelpers\Utilities\Db;
use Nng\Nnrestapi\Annotations as Api;
use Nng\Nnrestapi\Api\AbstractApi;
use Psr\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Post proposal
 *
 * @Api\Endpoint
 */
class Post extends AbstractApi
{
    public const REQUIRED_ARGUMENTS = ['email', 'identifier', 'pid', 'appPid'];

    public function __construct(
        private readonly Db $db,
        private readonly ProposalFromRequestPayload $proposalFromRequestPayload,
        private readonly EventDispatcherInterface $eventDispatcher
    ) {}

    /**
     * Call via POST-request with payload
     *
     * #### Required payload params:
     * * string `email`
     * * string `identifier`
     * * int `pid`,
     * * int `appPid`
     *
     * Example:
     *
     * https://www.mywebsite.com/api/proposal/
     *
     * ### Payload:
     *
     * ```
     * {
     * "email": "nix@foo.org",
     * "identifier": "any-string",
     * "pid": 1053,
     * "appPid": 1054,
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
     * ### Response:
     *
     * ```
     * {
     *   "code": 201,
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
     * @Api\Route("POST /proposal")
     * @Api\Access("public")
     * @Api\Localize
     * @return Response
     */
    public function postIndexAction(): Response
    {
        if (!$this->isRequestValid()) {
            // Return an `invalid parameters` (422) Response
            return $this->response->invalid(
                'Invalid parameters.',
                '1728420578'
            );
        }

        $proposal = $this->proposalFromRequestPayload->create($this->request);
        $proposal = $this->db->insert($proposal);

        if (!$proposal instanceof Proposal) {
            // Return a `not found` (404) Response
            return $this->response->error(
                400,
                'Proposal record could not be created',
                '1728420825'
            );
        }

        $this->response
            ->setMessage('success')
            ->setStatus(201);

        // Event dispatch after insert
        $this->eventDispatcher->dispatch(
            new ProposalPostAfterInsertEvent(
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
