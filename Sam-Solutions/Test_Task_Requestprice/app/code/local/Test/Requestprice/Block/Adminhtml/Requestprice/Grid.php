<?php
/*
 * Request Price list Admin grid
 *
 * @author Oleg Khuda
 */
class Test_Requestprice_Block_Adminhtml_Requestprice_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init Grid default properties
 *
 * */
    public function __construct()
    {
        parent::__construct();
        $this->setId('requestprice_list_grid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /*
     * Prepare collection for Grid
     *
     * @return Test_Requestprice_Block_Adminhtml_Requestprice_Grid
     * */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('test_requestprice/requestprice')->getResourceCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /*
     * Prepare Grid columns
     *
     * @return Test_Requestprice_Block_Adminhtml_Requestprice_Grid
     * */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'request_id',
            array(
                'header'=>Mage::helper('test_requestprice')->__('ID'),
                'width' =>'50px',
                'index' => 'request_id'
            )
        );

        $this->addColumn(
            'name',
            array(
                'header'=>Mage::helper('test_requestprice')->__('Name'),
                'index' => 'name'
            )
        );

        $this->addColumn(
            'email',
            array(
                'header'=>Mage::helper('test_requestprice')->__('Email'),
                'index' => 'email'
            )
        );


        $this->addColumn(
            'created_at',
            array(
                'header'=>Mage::helper('test_requestprice')->__('Created At'),
                'sortable' =>true,
                'width' =>'170px',
                'index' => 'created_at',
                'type' => 'datetime'
            )
        );
        $this->addColumn(
            'status',
            array(
                'header'=>Mage::helper('test_requestprice')->__('Status'),
                'index' => 'status',
            )
        );

        $this->addColumn(
            'action',
            array(
                'header'=>Mage::helper('test_requestprice')->__('Action'),
                'width' =>'100px',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption'=>Mage::helper('test_requestprice')->__('Edit'),
                        'url'=>array('base'=>'*/*/edit'),
                        'field'=>'id'
                    )
                ),
                'filter'=>false,
                'sortable'=>false,
                'index'=>'requestprice'
            )
        );
        return parent::_prepareColumns();
    }

    /*
     * Return row URL for js event handler
     *
     * @return string
     * */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }

    /*
      * Grid URL getter
      *
      * @return string current grid url
      * */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

}