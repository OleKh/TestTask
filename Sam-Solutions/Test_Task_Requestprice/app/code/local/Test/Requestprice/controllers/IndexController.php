<?php
/*
*  Request Price IndexController
 *
 * @author Oleg Khuda
 */

class Test_Requestprice_IndexController extends Mage_Core_Controller_Front_Action
{

   public function indexAction()
    {

       if ($this->getRequest()->getPost('isAjax')) {

           $data = $this->getRequest()->getPost();

           unset($data['isAjax']);
           unset($data['product_id']);

           // filter input data
           $data = $this->_filterPostData($data);

           // init model and set data
           $model = Mage::getModel('test_requestprice/requestprice');

           // validate input data
           $model->validate();

           // add data to model object
           $model->addData($data);

           // get core session object
           $session = Mage::getSingleton('core/session');

           try {

               // add data to model object from $_SERVER variable
               $sku = Mage::getModel('catalog/product')->load($this->getRequest()->getPost('product_id'))->getSku();
               $model->setProductSku($sku);
               $model->setStatus('New');
               // save the data
               $model->save();

               //display success message
               $session->addSuccess(
                   Mage::helper('test_requestprice')->__('The request has been saved.')
               );

               $response['message'] = 'ok';

           } catch (Mage_Core_Exception $e) {
               // catch exception and add error to session
               $response['status'] = 'ERROR';
               $session->addError($e->getMessage());
           } catch (Exception $e) {
               // catch exception and add exception to session
               $response['status'] = 'ERROR';
               $session->addException($e,
                   Mage::helper('test_requestprice')->__('An error occurred while saving the request.')
               );
           }
       }

       $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));

   }

    /*
       * filtering posted data.
       *
       * @param array $data
       * @return array
       * */
    protected function _filterPostData($data)
    {
        return Mage::getSingleton('core/input_filter_maliciousCode')->filter($data);
    }
}
