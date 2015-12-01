<?php
/*
*  Request Price Block
 *
 * @author Oleg Khuda
 */

class Test_Requestprice_Block_Requestprice extends Mage_Core_Block_Template
{

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
     * Retrieve form action url
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('requestprice/index/');
    }

}
