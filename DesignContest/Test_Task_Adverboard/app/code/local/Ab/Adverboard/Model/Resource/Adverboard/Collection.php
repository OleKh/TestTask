<?php
/**
 * Adverboard collection
 *
 * #author  Oleg Khuda
 */

class Ab_Adverboard_Model_Resource_Adverboard_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /*
    *  Define collection model
    */

    protected function _construct()
    {
        $this->_init('ab_adverboard/adverboard');
    }

    /*
     *    Prepare for displaying in list
     *
     *    @param integer $page
     *    @return Ab_Adverboard_Model_Resource_Adverboard_Collection
     * */

    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('ab_adverboard')->getAdvertPerPage());
        $this->setCurPage($page)->setOrder('published_at', Mage::helper('ab_adverboard')->getSortDirection());
        return $this;
    }
}