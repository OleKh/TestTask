<?php
/*
 * Request Price list admin Edit form block
 *
 * @author Oleg Khuda
 *  */
class Test_Requestprice_Block_Adminhtml_Requestprice_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /*
     * Prepare form action
     * @return Test_Requestprice_Block_Adminhtml_Requestprice_Edit_Form
     * */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form (
            array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/save'),
            'method'  => 'post',
            )
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}