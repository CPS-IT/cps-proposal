#
# Table structure for table 'tx_cpsitproposal_domain_model_proposal'
#
CREATE TABLE tx_cpsitproposal_domain_model_proposal
(
	uuid        varchar(100)     DEFAULT '' NOT NULL,
	email       varchar(100)     DEFAULT '' NOT NULL,
	proposal    text             DEFAULT NULL,
	status      int(4) unsigned  DEFAULT 0,
	record      varchar(255)     DEFAULT '' NOT NULL,
	identifier        varchar(255)     DEFAULT '' NOT NULL,
	request_log text             DEFAULT NULL
);
