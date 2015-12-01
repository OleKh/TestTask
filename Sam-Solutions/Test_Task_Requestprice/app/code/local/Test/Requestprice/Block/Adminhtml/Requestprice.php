<?php
/*
 * Request Price Admin grid container
 *
 * @author Oleg Khuda
 *
 * */
class Test_Requestprice_Block_Adminhtml_Requestprice extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /*
     * Block constructor
     * */
    public function __construct()
    {

        $this->_blockGroup = 'test_requestprice';
        $this->_controller = 'adminhtml_requestprice';
        $this->_headerText = Mage::helper('test_requestprice')->__('Request Price');

        parent::__construct();

        if (Mage::helper('test_requestprice/admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('test_requestprice')->__('Add New Request Price'));
        } else {
            $this->_removeButton('add');
        }

    }

}
