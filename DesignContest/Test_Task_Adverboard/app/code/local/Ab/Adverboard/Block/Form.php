<?php
/*
*  Advert Form Block
 *
 * @author Oleg Khuda
 */

class Ab_Adverboard_Block_Form extends Mage_Core_Block_Template
{

    /**
     * Retrieve form action url and set "secure" param to avoid confirm
     * message when we submit form from secure page to unsecure
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('adverboard/index/add', array('_secure' => true));
    }
}