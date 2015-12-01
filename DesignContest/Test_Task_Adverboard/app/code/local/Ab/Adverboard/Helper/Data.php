<?php
/*
 * Adverboard Data helper
 *
 * @author Oleg Khuda
 * */

class Ab_Adverboard_Helper_Data extends Mage_Core_Helper_Data
{

    /*
         * Count of avert post per page
         * @var int
         * */
    const ITEMS_PER_PAGE = 20;

    /*
        * Enable advert display
        * @var boolean
        * */
    const ITEM_DISPLAY = true;

    /*
     * Advert Item instance for lazy loading     *
     * @var Ab_Adverboard_Model_Adverboard
     * */
    protected $_advertItemInstance;

    /* Checks whether advert can be displayed in the frontend
     *
     * @return boolean
    */

    public function isEnabled()
    {
        return self::ITEM_DISPLAY ? true : false;
    }

    /* Return the number of items per page
     *
      * @return int
      */
    public function getAdvertPerPage()
    {
      return abs((int)self::ITEMS_PER_PAGE);
    }

    /*Return current advert item instance from the Registry
     *
     * @return Ab_Adverboard_Model_Adverboard
     */
    public function getAdvertItemInstance()
    {
        if(!$this->_advertItemInstance){
            $this->_advertItemInstance = Mage::registry('advert_item');
            if (!$this->_advertItemInstance) {
                Mage::throwException($this->__('advert item instance does not exist in Registry'));
            }
        }
        return $this->_advertItemInstance;
    }

    /*Return a session saved sort direction or ASC direction
    *
    * @return string
    */

    public function getSortDirection(){
       $session = Mage::getSingleton('ab_adverboard/session');
       $dir = $session->getData('dir');
       return $dir ? $dir: Varien_Data_Collection::SORT_ORDER_ASC;
     }

} 