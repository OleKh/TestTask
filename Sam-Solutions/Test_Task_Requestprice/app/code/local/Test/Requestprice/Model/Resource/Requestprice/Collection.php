<?php
/*
*  Request Price Collection Model
 *
 * @author Oleg Khuda
 */

class Test_Requestprice_Model_Resource_Requestprice_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /*
    *  Define collection model
    */

    protected function _construct()
    {
        $this->_init('test_requestprice/requestprice');
    }

}