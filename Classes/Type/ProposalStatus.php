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
    case Published = 7;

    public static function status(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }

    public static function fromName(string $name): ?self
    {
        $result = array_search($name, self::status(), true);
        if (!$result) {
            return null;
        }
        return self::tryFrom($result);
    }

    public static function getIconIdentifier(self $value): string
    {
        return match ($value) {
            self::Undefined => 'icon-proposal-status-undefined',
            self::New => 'icon-proposal-status-new',
            self::Edited => 'icon-proposal-status-edited',
            self::Approved => 'icon-proposal-status-approved',
            self::Rejected => 'icon-proposal-status-rejected',
            self::Withdraw => 'icon-proposal-status-withdraw',
            self::Error => 'icon-proposal-status-error',
            self::Published => 'icon-proposal-status-published',
        };
    }
}
