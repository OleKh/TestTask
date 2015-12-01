<?php
/*
 * Request Price List Admin Edit form main tab
 *
 *  @author Oleg Khuda
 */
class Test_Requestprice_Block_Adminhtml_Requestprice_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /*
     * Prepares form elements for tab
     * @return  Mage_adminhtml_Block_Widget_Form
     * */
    protected function _prepareForm()
    {
        $model = Mage::helper('test_requestprice')->getPriceRequestInstance();

        /*
         * Checking if user have permissions to save information
         * */
        if (Mage::helper('test_requestprice/admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('requestprice_main_');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            array(
                'legend'=>Mage::helper('test_requestprice')->__('Request price Item Info')
            )
        );

        if($model->getId()){
            $fieldset->addField(
                'request_id',
                'hidden',
                array(
                   'name' =>'request_id'
                )
            );

        }

        $fieldset->addField(
            'name',
            'text',
            array(
            'name'=>'name',
            'label'    => Mage::helper('test_requestprice')->__('Request Price Title'),
            'title'    => Mage::helper('test_requestprice')->__('Request Price Title'),
            'required'=>true,
            'disabled' => $isElementDisabled
            )
        );

        $fieldset->addField(
            'email',
            'text',
            array(
                'name'=>'email',
                'label'=>Mage::helper('test_requestprice')->__('Email'),
                'title'=>Mage::helper('test_requestprice')->__('Email'),
                'required'=>true,
            'disabled' => $isElementDisabled
            )
        );

        $fieldset->addField(
            'product_sku',
            'text',
            array(
                'name'=>'product_sku',
                'label'=>Mage::helper('test_requestprice')->__('Product SKU'),
                'title'=>Mage::helper('test_requestprice')->__('Product SKU'),
                'required'=>true,
                'disabled' => $isElementDisabled
            )
        );

        $fieldset->addField(
            'comment',
            'textarea',
            array(
                'name'=>'comment',
                'label'=>Mage::helper('test_requestprice')->__('Comment'),
                'title'=>Mage::helper('test_requestprice')->__('Comment'),
                'required'=>true,
                'disabled' => $isElementDisabled
            )
        );

        $fieldset->addField(
            'status',
            'select',
            array(
                'name'=>'status',
                'label'=>Mage::helper('test_requestprice')->__('Status'),
                'title'=>Mage::helper('test_requestprice')->__('Status'),
                'required'=>true,
                'values' => array(
                    'In_progress'=>'In progress',
                    'Closed'=>'Closed',
                    'New'=>'New',
                )
            )
        );

        Mage::dispatchEvent('adminhtml_requestprice_edit_tab_main_prepare_form',
            array(
                'form'=>$form
            )
        );
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /*
     * Prepare label for tab
     * @return string
     * */
    public function getTabLabel()
    {
        return Mage::helper('test_requestprice')->__('Request Price Info');
    }
     /*
     * Prepare title for tab
     * @return string
     * */
    public function getTabTitle()
    {
        return Mage::helper('test_requestprice')->__('Request Price Info');
    }

    /*
     * Returns status flag about this tab can be shown or not
     * @return true
     * */
    public function canShowTab()
    {
        return true;
    }

        /*
     * Returns status flag about this tab hidden or not
     * @return false
     * */
    public function isHidden()
    {
        return false;
    }
}