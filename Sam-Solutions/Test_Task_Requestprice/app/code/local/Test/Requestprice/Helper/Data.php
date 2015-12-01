<?php
/*
 * Price Request Data helper
 *
 * @author Oleg Khuda
 * */

class Test_Requestprice_Helper_Data extends Mage_Core_Helper_Data
{

    /*
   * Path to store config if frontend output is enabled
   * @var string
   * */
    const XML_PATH_ENABLED = 'requestprice/view/enabled';

    /*
     * Price Request instance for lazy loading
     * @var Test_Requestprice_Model_Requestprice
     * */
    protected $_priceRequestInstance;

    /* Checks whether Request Price extension can be displayed in the frontend
     *
     * @return boolean
    */

    public function isEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $store);
    }


    /*Return current instance from the Registry
     *
     * @return Test_Requestprice_Model_Requestprice
     */
    public function getPriceRequestInstance()
    {
        if(!$this->_priceRequestInstance){
            $this->_priceRequestInstance = Mage::registry('requestprice_item');
            if (!$this->_priceRequestInstance) {
                Mage::throwException($this->__('Price Request instance does not exist in Registry'));
            }
        }
        return $this->_priceRequestInstance;
    }

} 