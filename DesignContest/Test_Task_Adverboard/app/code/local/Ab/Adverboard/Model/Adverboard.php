<?php
/**
 * Adverboard item model
 *
 * #author  Oleg Khuda
 */

class Ab_Adverboard_Model_Adverboard extends Mage_Core_Model_Abstract
{

/*
 *     Define resource model
 * */

    protected function _construct()
    {
        $this->_init('ab_adverboard/adverboard');
    }

    /**
     * Validate post input data
     *
     * @return boolean | array
     **/

    public function validate()
    {
        $errors = array();

        $helper = Mage::helper('ab_adverboard');

        if (!Zend_Validate::is($this->getName(), 'NotEmpty')) {
              $errors[] = $helper->__('Name can\'t be empty');
        }

        if (!Zend_Validate::is($this->getContent(), 'NotEmpty')) {
            $errors[] = $helper->__('Content can\'t be empty');
        }

        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

}

