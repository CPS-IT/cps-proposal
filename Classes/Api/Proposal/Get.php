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
use Nng\Nnhelpers\Utilities\Db;
use Nng\Nnrestapi\Annotations as Api;
use Nng\Nnrestapi\Api\AbstractApi;
use TYPO3\CMS\Core\Http\Response;

/**
 * Get proposal record
 *
 * @Api\Endpoint()
 */
class Get extends AbstractApi
{
    const UUID_ARGUMENT = 'id';

    public function __construct(
        protected readonly Db $db
    ) {
    }

    /**
     * Call via GET-request with an uuid: https://www.mywebsite.com/api/proposal/1
     *
     * @Api\Route("GET /proposal/{id}")
     * @Api\Access("public")
     * @Api\Localize()
     * @return Response
     */
    public function getIndexAction(): Response
    {
        $uuid = $this->request->getArguments()[static::UUID_ARGUMENT] ?? null;

        if (!$uuid) {
            // Return an `invalid parameters` (422) Response
            return $this->response->invalid(
                'Invalid parameters.',
                '1728420636'
            );
        }

        $proposal = $this->db->findOneByValues(
            Proposal::TABLE_NAME,
            [
                Proposal::FIELD_UUID => $uuid,
            ]
        );

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
}
