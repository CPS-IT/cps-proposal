<?php

declare(strict_types=1);

namespace Cpsit\CpsitProposal\Updates;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\AbstractListTypeToCTypeUpdate;

#[UpgradeWizard('cpsitCpsitProposalCTypeMigration')]
final class CpsitCpsitProposalCTypeMigration extends AbstractListTypeToCTypeUpdate
{
    public function getTitle(): string
    {
        return 'Migrate "Cpsit CpsitProposal" plugins to content elements.';
    }

    public function getDescription(): string
    {
        return 'The "Cpsit CpsitProposal" plugins are now registered as content element. Update migrates existing records and backend user permissions.';
    }

    /**
     * This must return an array containing the "list_type" to "CType" mapping
     *
     *  Example:
     *
     *  [
     *      'pi_plugin1' => 'pi_plugin1',
     *      'pi_plugin2' => 'new_content_element',
     *  ]
     *
     * @return array<string, string>
     */
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            'cpsitproposal_app' => 'cpsitproposal_app',
        ];
    }
}
