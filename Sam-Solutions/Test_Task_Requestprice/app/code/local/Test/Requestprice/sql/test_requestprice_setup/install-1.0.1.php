<?php
//exit;
//echo "sql";
//return;
/**
 * Request price installation script
 *
 * @author Oleg Khuda
 */


/*
 * @var $installer Mage_Core_Model_Resource_Setup
 * */

$installer = $this;

/*
 * Creating table test_requestprice
 * */

$table = $installer->getConnection()
    ->newTable($installer->getTable('test_requestprice/requestprice'))
    ->addColumn('request_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'identity' => true,
        'nullable' => false,
        'primary' => true
    ), 'Entity id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => true,
    ), 'Name')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_VARCHAR, 128, array(
        'nullable' => true,
        'default' => null
    ), 'Email')
    ->addColumn('comment', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
        'nullable' => true,
        'default' => null
    ), 'Comment')
    ->addColumn('product_sku', Varien_Db_Ddl_Table::TYPE_VARCHAR, 64, array(
        'nullable' => true,
        'default' => null
    ), 'Product Sku')
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32, array(
        'nullable' => true,
        'default' => null
    ), 'Status5')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable' => true,
        'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT
    ), 'Creation Time')
    ->addIndex($installer->getIdxName(
            $installer->getTable('test_requestprice/requestprice'),
            array('created_at'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
        ),
        array('created_at'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX)
    )
    ->setComment('Requestprice item');

$installer->getConnection()->createTable($table);



