<?php
/*
*  Request Price Resource Model
 *
 * @author Oleg Khuda
 */

class Test_Requestprice_Model_Resource_Requestprice extends Mage_Core_Model_Resource_Db_Abstract
{
/*
   initialize connection and define main table and primary key
*/
    protected function _construct()
    {
        $this->_init('test_requestprice/requestprice', 'request_id');
    }

} 