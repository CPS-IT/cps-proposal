<?php
declare(strict_types=1);

/*
 * This file is part of the cpsit_proposal project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Cpsit\CpsitProposal\Type;

enum ProposalStatus: int
{

    case Undefined = 0;
    case New = 1;
    case Edited = 2;
    case Approved = 3;
    case Rejected = 4;
    case Withdraw = 5;
    case Error = 6;

    public static function status(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
