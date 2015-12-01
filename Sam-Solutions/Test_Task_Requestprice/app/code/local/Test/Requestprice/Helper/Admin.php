<?php
/*
*  Request Price Admin Helper
 *
 * @author Oleg Khuda
 */

class Test_Requestprice_Helper_Admin extends Mage_Core_Helper_Abstract
{
    /*
     * Check permission for passed action
     *
     * @param string $action
     * @return bool
     * */
    public function isActionAllowed($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('requestprice/manage/' . $action);
    }
}
