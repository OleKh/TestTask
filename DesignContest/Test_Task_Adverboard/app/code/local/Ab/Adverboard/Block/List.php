<?php
/*
*  Advert List Block
 *
 * @author Oleg Khuda
 */

class Ab_Adverboard_Block_List extends Mage_Core_Block_Template
{
    /*
    * Advert Collection
    *
    * @var Ab_Adverboard_Model_Resource_Adverboard_Collection
    */
    protected $_advertCollection = null;

    /* Retrieve advert collection
    *
    * @return Ab_Adverboard_Model_Resource_Adverboard_Collection
    */
    protected function _getCollection()
    {
        return Mage::getResourceModel('ab_adverboard/adverboard_collection');
    }
    /* Retrieve prepared advert collection
    *
    * @return Ab_Adverboard_Model_Resource_Adverboard_Collection
    */
    public function getCollection()
    {
        if(is_null($this->_advertCollection))
        {
            $this->_advertCollection = $this->_getCollection();
            $this->_advertCollection->prepareForList($this->getCurrentPage(),  Mage::helper('ab_adverboard')->getSortDirection());
        }
        return $this->_advertCollection;
    }
    /*
     * Return URL to item`s view page
     *
     * @param Ab_Adverboard_Model_Resource_Adverboard_Collection;
     * @return string
     *  */
    public function getItemUrl ($advertItem)
    {
        return $this->getUrl('*/*/view', array('id'=>$advertItem->getId()));
    }

    /*
     * Return URL to sort direction ASC/DESC
     *
     * @param string;
     * @return string
     *  */
    public function getDirListUrl ($val)
    {
        return $this->getUrl('*/', array('dir'=>$val));
    }

    /*
     * Fetch the current page for the advert list
     *
     * @return int
    */
    public function getCurrentPage()
    {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }
    /*
     * Get a pager
     *
     * @return string|null
     * */
    public function getPager()
    {
        $pager = $this->getChild('adverboard_list_pager');

        if ($pager) {
            $advertPerPage = Mage::helper('ab_adverboard')->getAdvertPerPage();
            $pager->setAvailableLimit(array($advertPerPage => $advertPerPage));
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(true);
            return $pager->toHtml();
        }
    }
    /*
     * Return URL for resized advert Item image
     *
     * @param Ab_Adverboard_Model_Adverboard $item;
     * @param integer $width
     * @return string|false
     *   */
    public function getImageUrl($item, $width)
    {
        return Mage::helper('ab_adverboard/image')->resize($item, $width);
    }



}