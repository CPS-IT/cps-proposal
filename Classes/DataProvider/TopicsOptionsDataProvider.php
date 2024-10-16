<?php

namespace Cpsit\CpsitProposal\DataProvider;

use Cpsit\Formkit\DataProvider\SelectOptionsDataProviderInterface;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2024 Dirk Wenzel <wenzel@cps-it.de>
 *  All rights reserved
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * A copy is found in the text file GPL.txt and important notices to the license
 * from the author is found in LICENSE.txt distributed with these scripts.
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
class TopicsOptionsDataProvider implements SelectOptionsDataProviderInterface
{
    public const DATA_PROVIDER_KEY = 'zug-caretaker-topics';

    public function getKey(): string
    {
        return self::DATA_PROVIDER_KEY;
    }

    /**
     * @inheritDoc
     */
    public function getOptions(): array
    {
        return [
            [
                self::KEY_LABEL => "topic foo",
                self::KEY_VALUE => "topic-foo-value",
            ],
            [
                self::KEY_LABEL => "topic bar",
                self::KEY_VALUE => "topic-bar-value",
            ]
        ];
    }
}
