# CPS Proposals

Reusable (CRUD) component to post data in a TYPO3 system.

## Usage

Add table name to allowed record in record field.

```php
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToInsertRecords(
    'your_table_name_here',
    'tx_cpsitproposal_domain_model_proposal',
    'record'
);
```

