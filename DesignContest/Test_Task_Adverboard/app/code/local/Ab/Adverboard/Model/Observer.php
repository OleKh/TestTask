<?php
/*
 * Adverboard observer model
 *
 * @author Oleg Khuda
 **/

class Ab_Adverboard_Model_Observer
{
    /*
     * Event before show adverboard item on frontend
     *
     * @param Varien_Event_Observer $observer
     */
    public function beforeAdvertDisplay(Varien_Event_Observer $observer)
    {
        return true;
    }
}