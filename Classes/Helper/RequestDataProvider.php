<?php

declare(strict_types=1);

/*
 * This file is part of the cpsit-proposal project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Helper;

use Nng\Nnrestapi\Mvc\Request;

class RequestDataProvider
{
    public function get(Request $request): array
    {
        return [
            'endpoint' => $request->getEndpoint(),
            'uri' => $request->getMvcRequest()->getUri(),
            'body' => $request->getBody(),
        ];
    }
}
