<?php
    /*
     * Request Price list Admin edit form container
     *
     * @author Oleg Khuda
 */
class Test_Requestprice_Block_Adminhtml_Requestprice_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize edit form container
     *
     * */
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'test_requestprice';
        $this->_controller = 'adminhtml_requestprice';

        parent::__construct();

        if (Mage::helper('test_requestprice/admin')->isActionAllowed('save')) {
            $this->_updateButton('save', 'label', Mage::helper('test_requestprice')->__('Save Request Item'));
            $this->_addButton('saveandcontinue', array(
                'label'   => Mage::helper('adminhtml')->__('Save and Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ), -100);
        } else {
            $this->_removeButton('save');
        }

        if (Mage::helper('test_requestprice/admin')->isActionAllowed('delete')) {
            $this->_updateButton('delete', 'label', Mage::helper('test_requestprice')->__('Delete Request Item'));
        } else {
            $this->_removeButton('delete');
        }

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('page_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'page_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'page_content');
                }
            }
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /*
     * Retrieve text for header element depending on loaded page
     *
     *  @return string     *
     * */
    public function getHeaderText()
    {
        $model = Mage::helper('test_requestprice')->getPriceRequestInstance();

        if ($model->getId()) {
            return Mage::helper('test_requestprice')->__("Edit Request Item '%s'",
                 $this->escapeHtml($model->getTitle()));
        } else {
            return Mage::helper('test_requestprice')->__('New Request Item');
        }
    }
}
