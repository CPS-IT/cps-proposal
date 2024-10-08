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
use Cpsit\CpsitProposal\Helper\CreateProposalFromPostRequest;
use Doctrine\Common\Annotations\Annotation\Required;
use Nng\Nnhelpers\Utilities\Db;
use Nng\Nnrestapi\Annotations as Api;
use Nng\Nnrestapi\Api\AbstractApi;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Post proposal
 *
 * @Api\Endpoint()
 */
class Post extends AbstractApi
{
    const REQUIRED_ARGUMENTS = ['validationHash', 'email', 'identifier', 'pid'];

    public function __construct(
        protected readonly Db $db,
        protected CreateProposalFromPostRequest $createProposalRequest,
    ) {
    }

    /**
     * Call via POST-request with payload https://www.mywebsite.com/api/proposal/1
     * Required params: validationHash, email, identifier, pid
     *
     * ### Proposal:
     *
     * ```
     * {
     * "validationHash": "8743b52063cd84097a65d1633f5c74f5",
     * "email": "nix@foo.org",
     * "identifier": "any-string",
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
     * "code": 201,
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
     * @Api\Route("POST /proposal")
     * @Api\Access("public")
     * @Api\Localize()
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

        $proposal = $this->createProposalRequest->create($this->request);
        $proposal = \nn\t3::Db()->insert($proposal);

        if (!$proposal instanceof Proposal) {
            // Return a `not found` (404) Response
            return $this->response->error(
                400,
                'Proposal record could not be created',
                '1728420825'
            );
        }

        return $this->response
            ->setMessage('success')
            ->setStatus(201)
            ->setBody([
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
