<?php
/**
 * Adverboard item resource model
 * #author  Oleg Khuda
 */

class Ab_Adverboard_Model_Resource_Adverboard extends Mage_Core_Model_Resource_Db_Abstract
{
/*
   initialize connection and define main table and primary key
*/
    protected function _construct()
    {
        $this->_init('ab_adverboard/adverboard', 'advert_id');
    }

} 