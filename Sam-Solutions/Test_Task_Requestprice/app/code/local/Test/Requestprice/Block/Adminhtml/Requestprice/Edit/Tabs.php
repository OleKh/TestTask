<?php
/*
 * Request Price list admin Edit form tabs block
 *
 * @author Oleg Khuda
 *  */
class Test_Requestprice_Block_Adminhtml_Requestprice_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /*
     * Initialize tabs and define tabs block settings
     * */
    public function __construct()
    {
        parent::__construct();
        $this->setId('page_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('test_requestprice')->__('Request Price Info'));
    }
}
