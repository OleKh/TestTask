<?php
/*
 * Adverboard session model
 *
 * @author Oleg Khuda
 **/

class Ab_Adverboard_Model_Session extends Mage_Core_Model_Session_Abstract
{
    public function __construct()
    {
         $this->init('ab_adverboard');
    }

    public function getDisplayMode()
    {
        return $this->_getData('display_mode');
    }

}
