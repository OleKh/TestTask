<?php
/*
*  Request Price Model
 *
 * @author Oleg Khuda
 */

class Test_Requestprice_Model_Requestprice extends Mage_Core_Model_Abstract
{

/*
 *     Define resource model
 * */

    protected function _construct()
    {
        $this->_init('test_requestprice/requestprice');
    }

    /**
     * Validate post input data
     *
     * @return boolean | array
     **/

    public function validate()
    {
        $errors = array();

        $helper = Mage::helper('test_requestprice');

        if (!Zend_Validate::is($this->getName(), 'NotEmpty')) {
              $errors[] = $helper->__('Name can\'t be empty');
        }

        if (!Zend_Validate::is($this->getEmail(), 'NotEmpty')) {
            $errors[] = $helper->__('Email can\'t be empty');
        }

        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

}

