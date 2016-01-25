<?php 
$installer = $this;
$installer->startSetup();
$installer->run("DELETE FROM `{$installer->getTable('core_config_data')}` WHERE `path` = 'currency/import/enabled';
	DELETE FROM `{$installer->getTable('core_config_data')}` WHERE `path` = 'currency/import/service'; 
	INSERT INTO `{$installer->getTable('core_config_data')}` VALUES(NULL ,  'default',  '0',  'currency/import/enabled',  '1');
	INSERT INTO `{$installer->getTable('core_config_data')}` VALUES(NULL ,  'default',  '0',  'currency/import/service',  'nfusionsolutions_currencyexchangerates');
");
$installer->endSetup();?>