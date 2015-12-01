<?php
//echo "sql";
//return;
/**
 * Advertboard installation script
 *
 * @author Oleg Khuda
 */


/*
 * @var $installer Mage_Core_Model_Resource_Setup
 * */

$installer = $this;

/*
 * Creating table ab_adverboard
 * */

$table = $installer->getConnection()
    ->newTable($installer->getTable('ab_adverboard/adverboard'))
    ->addColumn('advert_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'identity' => true,
        'nullable' => false,
        'primary' => true
    ), 'Entity id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => true,
    ), 'Name')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
        'nullable' => true,
        'default' => null
    ), 'Content')
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
        'default' => null
    ), 'Advert image media path')
    ->addColumn('author_ip', Varien_Db_Ddl_Table::TYPE_VARCHAR, 15, array(
        'nullable' => true,
        'default' => null
    ), 'Author IP')
    ->addColumn('author_browser', Varien_Db_Ddl_Table::TYPE_TEXT, 128, array(
        'nullable' => true,
        'default' => null
    ), 'Author Browser')
    ->addColumn('author_country', Varien_Db_Ddl_Table::TYPE_TEXT, 63, array(
        'nullable' => true,
        'default' => null
    ), 'Author Country')
    ->addColumn('published_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable' => true,
        'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT
    ), 'Published date')
    ->addIndex($installer->getIdxName(
            $installer->getTable('ab_adverboard/adverboard'),
            array('published_at'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
        ),
        array('published_at'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX)
    )
    ->setComment('Advert item');

$installer->getConnection()->createTable($table);



