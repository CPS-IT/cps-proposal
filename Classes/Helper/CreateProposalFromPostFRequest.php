<?php
/*
 * This file is part of the zug-bundle project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Helper;

use Cpsit\EventSubmission\Domain\Model\ApiResponseInterface;
use Cpsit\EventSubmission\Type\SubmissionStatus;
use Nng\Nnrestapi\Mvc\Request;
use Nng\Nnrestapi\Mvc\Response;
//use Symfony\Component\Uid\Uuid;

final class CreateProposalFromPostFRequest
{
    public function __invoke(Request $request): array
    {
        return [
            //'uuid' => Uuid::uuid4()->toString(),
            'status' => SubmissionStatus::NEW,
            'email' => $request->getBody()['email'],
            'requestDateTime' => (new \DateTime('NOW')),
            'payload' => $request->getRawBody(),
            'responseCode' => ApiResponseInterface::EVENT_SUBMISSION_SUCCESS,
            'isApiError' => false,
            'pid' => (int)$request->getSettings()['insertDefaultValues']['Cpsit\EventSubmission\Domain\Model\Job']['pid'] ?? 0
        ];
    }
}
