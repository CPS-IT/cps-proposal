<?php

declare(strict_types=1);

/*
 * This file is part of the cpsit-proposal project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Api\Validation;

use Cpsit\CpsitProposal\Event\ValidationEmailPostEvent;
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
class Email extends AbstractApi
{
    public const REQUIRED_ARGUMENTS = ['email', 'identifier', 'pid', 'appPid', 'validationHash'];

    public function __construct(
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
     * * string `validationHash`
     *
     * Example:
     *
     * https://www.mywebsite.com/api/proposal/
     *
     * ### Payload:
     *
     * ```
     * {
     *   "email": "nix@foo.org",
     *   "identifier": "any-string",
     *   "pid": 1053,
     *   "appPid": 1053,
     *   "validationHash": "dfde719e-9f19-40b5-af2e-6f96d4034cda"
     * }
     * ```
     *
     * ### Response:
     *
     * ```
     * {
     *   "code": 202,
     *   "message": "success",
     *   "data": {
     *      "validationHash": "dfde719e-9f19-40b5-af2e-6f96d4034cda"
     *   }
     * }
     * ```
     *
     * @Api\Route("POST /proposal/validation/email")
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
                '1728571847'
            );
        }

        $data = [
            'validationHash' => $this->request->getBody()['validationHash'],
        ];

        $this->response
            ->setMessage('success')
            ->setStatus(202);

        /** @var ValidationEmailPostEvent $event */
        $event = $this->eventDispatcher->dispatch(
            new ValidationEmailPostEvent(
                $data,
                $this->response,
                $this->request
            )
        );

        if ($data !== $event->getData()) {
            $data = $event->getData();
        }

        return $this->response->setBody([
            'code' => $this->response->getStatus(),
            'message' => $this->response->getMessage(),
            'data' => $data,
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
