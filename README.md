# CPS Proposals

Reusable (CRUD) component to post data in a TYPO3 system.

## Usage

## Proposal identifier

## Allowed proposal records

Add a table name to the list of allowed records in TCA for the proposal table
field record.

Example:

Add a file to your extension to extend tt_content TCA:

`Configuration/TCA/Overrides/tt_content.php`

```php
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToInsertRecords(
    '[your_table_name_here]',
    'tx_cpsitproposal_domain_model_proposal',
    'record'
);
```
Replace `[your_table_name_here]` with the name of table you need to add.

