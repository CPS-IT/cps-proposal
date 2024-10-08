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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Post proposal
 *
 * @Api\Endpoint()
 */
class Post extends AbstractApi
{
    const UUID_ARGUMENT = 'id';

    public function __construct(
        protected readonly Db $db
    ) {
    }

    /**
     * Call via POST-request with payload https://www.mywebsite.com/api/proposal/1
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
            return $this->response->invalid();
        }



        if (empty($proposal)) {
            // Return a `not found` (404) Response
            return $this->response->notFound(
                'Proposal record not found',
            );
        }

        // Return an `found, OK` (200) Response
        return $this->response->success($proposal);
    }


    protected function isRequestValid(): bool
    {
        $arguments = $this->request->getArguments();
        if (!GeneralUtility::validEmail($arguments['email'] ?? null)
        ) {
            return false;
        }

        if (!is_string($requestBody['validationHash'] ?? null)) {
            return false;
        }

        return true;
    }

}
