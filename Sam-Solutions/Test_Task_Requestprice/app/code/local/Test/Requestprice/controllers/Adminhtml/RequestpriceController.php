<?php
/*
*  Request Price Admin RequestpriceController
 *
 * @author Oleg Khuda
 */

class Test_Requestprice_Adminhtml_RequestpriceController extends Mage_Adminhtml_Controller_Action
{
    /*
     * Init action
     *
     * @returnTest_Requestprice_Adminhtml_RequestpriceController
     * */
    protected function _initAction()
    {

        //load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('requestprice/manage')
            ->_addBreadcrumb(
                  Mage::helper('test_requestprice')->__('Request price'),
                  Mage::helper('test_requestprice')->__('Request price')
            )
            ->_addBreadcrumb(
                  Mage::helper('test_requestprice')->__('Manage request price'),
                  Mage::helper('test_requestprice')->__('Manage request price')
              )
        ;
        return $this;
    }

    /*
     * Index action
     * */
    public function indexAction()
    {
        $this->_title($this->__('Request price'))
             ->_title($this->__('Manage request price'));

        $this->_initAction();
        $this->renderLayout();
    }

    /*
     * Create new request price
     * */
    public function newAction()
    {
        //the same form is used to create and edit
        $this->_forward('edit');
    }

    /*
     * Edit request price
     * */
    public function editAction()
    {
        $this->_title($this->__('Request price'))
             ->_title($this->__('Manage request price'));

        // 1. Instance RP model
//        /*  @var $model Test_Requestprice_Model_Requestprice */
        $model = Mage::getModel('test_requestprice/requestprice');

        //2. Id ID exists check it and load data
        $reqpriceId = $this->getRequest()->getParam('id');
        if ($reqpriceId) {
            $model->load($reqpriceId);

            if (!$model->getId()) {
                $this->_getSession()->addError(
                    Mage::helper('test_requestprice')->__('Request price item does not exist.')
                );
                return $this->_redirect('*/*/');
            }
            // prepare title
            $this->_title($model->getTitle());
            $breadCrumb = Mage::helper('test_requestprice')->__('Edit Item');
        } else {
            $this->_title(Mage::helper('test_requestprice')->__('New Item'));
            $breadCrumb = Mage::helper('test_requestprice')->__('New Item');
        }
        // init breadcrumbs
        $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);

        // 3. Set entered data if there was an error during save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        // 4. Register model to use later in blocks
        Mage::register('requestprice_item', $model);

        // 5. Render layout
        $this->renderLayout();
    }

    /*
     * Save action
     * */
    public function saveAction()
    {
        $redirectPath = '*/*';
        $redirectParams = array();

        // check if data sent
        $data = $this->getRequest()->getPost();
        if ($data) {
            $data = $this->_filterPostData($data);

            // init model and set data
            /*  @var $model Test_Requestprice_Model_Requestprice */
            $model = Mage::getModel('test_requestprice/requestprice');

            //if request item exists try to load it
            $reqpriceId = $this->getRequest()->getParam('request_id');
            if ($reqpriceId) {
                $model->load($reqpriceId);
            }

            $model->addData($data);

            try {
                $hasError = false;

                // save the data
                $model->save();

                //display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('test_requestprice')->__('The request price item has been saved.')
                );

                //check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $redirectPath   = '*/*/edit';
                    $redirectParams = array('id' => $model->getId());
                }
            } catch (Mage_Core_Exception $e) {
                $hasError = true;
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $hasError = true;
                $this->_getSession()->addException($e,
                    Mage::helper('test_requestprice')->__('An error occurred while saving the request price item.')
                );
            }

            if ($hasError) {
                $this->_getSession()->setFormData($data);
                $redirectPath   = '*/*/edit';
                $redirectParams = array('id' => $this->getRequest()->getParam('id'));
            }
        }

        $this->_redirect($redirectPath, $redirectParams);
    }

    /*
     * Delete Action
     * */
    public function deleteAction()
    {
        // check if we know what should be deleted
        $itemId = $this->getRequest()->getParam('id');
        if ($itemId) {
            try {
                //init model and delete
                /* @var $model Test_Requestprice_Model_Requestprice */
                $model = Mage::getModel('test_requestprice/requestprice');
                $model->load($itemId);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('test_requestprice')->__('Unable to find a request price item.'));
                }
                $model->delete();

                //display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('test_requestprice')->__('The request has been deleted.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addException($e,
                    Mage::helper('test_requestprice')->__('An error occurred while deleting the request price item.')
                );
            }
        }

        //go to grid
        $this->_redirect('*/*/');
    }

    /*
     * Check the permision to run it
     *
     * @return boolean
     * */
    protected function _isAllowed()
    {
        switch ($this->getRequest()->getActionName()) {
            case 'new':
            case 'save':
                return Mage::getSingleton('admin/session')->isAllowed('requestprice/manage/save');
                break;
          case 'delete':
                return Mage::getSingleton('admin/session')->isAllowed('requestprice/manage/delete');
            default:
                return Mage::getSingleton('admin/session')->isAllowed('requestprice/manage');
        }
    }

    /*
     * filtering posted data. Converting localized data if needed
     *
     * @param array $data
     * @return array
     * */
    protected function _filterPostData($data)
    {
        $data = $this->_filterDates($data, array('time_published'));
        return $data;
    }

    /*
     * Grid Ajax action
     * */
    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

}