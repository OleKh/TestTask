<?php
/*
 * Adverboard frontend controller
 *
 * @author Oleg Khuda
 **/

class Ab_Adverboard_IndexController extends Mage_Core_Controller_Front_Action
{
    /*    pre dispatch action that allows to redirect to no route page in case of
        disabled extension through Admin panel*/
    public function preDispatch()
    {
        parent::preDispatch();
        if (!Mage::helper('ab_adverboard')->isEnabled()) {
            $this->setFlag('', 'no-dispatch', true);
            $this->_redirect('noRoute');
        }
    }

    /*
     * Index action
    * */
    public function indexAction()
    {
        // set a sorting direction to the session
        $session = Mage::getSingleton('ab_adverboard/session');
        if ($dir = $this->getRequest()->getParam('dir'))
            $session->setData('dir', $dir);

        // load layout
        $this->loadLayout();

        //  get block object by name
        $listBlock = $this->getLayout()->getBlock('adverboard.list');

        // set current page
        if ($listBlock) {
            $currentPage = abs(intval($this->getRequest()->getParam('p')));
            if ($currentPage < 1) {
                $currentPage = 1;
            }
            $listBlock->setCurrentPage($currentPage);
        }

        // rendering layout
        $this->renderLayout();
    }

    /*
       Advert view action
    */
    public function viewAction()
    {

        // get advert id If not redirect to noRoute page
        $advertId = $this->getRequest()->getParam('id');
        if (!$advertId) {
            $this->_forward('noRoute');
            return;
        }
        /*
         *      @var $model Ab_Adverboard_Model_Adverboard
         * */

        // retrieve adverboard model object and load advert id
        $model = Mage::getModel('ab_adverboard/adverboard');
        $model->load($advertId);
        if (!$model->getId()) {
            $this->_forward('noRoute');
            return;
        }

        // register an advert_item variable in Registry
        Mage::register('advert_item', $model);

        // calls observer callback registered for this event
        Mage::dispatchEvent('before_advert_display', array('advert_item' => $model));

        // load layout
        $this->loadLayout();

        // get block object by name
        $itemBlock = $this->getLayout()->getBlock('adverboard.item');

        // set page
        if ($itemBlock) {
            $listBlock = $this->getLayout()->getBlock('advertboard.list');
            if ($listBlock) {
                $page = (int)$listBlock->getCurrentPage() ? (int)$listBlock->getCurrentPage() : 1;
            } else {
                $page = 1;
            }
            $itemBlock->setPage($page);
        }

        // rendering layout
        $this->renderLayout();
    }

    /*
    Advert add action
    */
    public function addAction()
    {

        // check if data sent
        if ($data = $this->getRequest()->getPost()) {

            // filter input data
            $data = $this->_filterPostData($data);

            // init model and set data
            /*  @var $model Ab_Adverboard_Model_Adverboard */
            $model = Mage::getModel('ab_adverboard/adverboard');

            //remove image from data array
            if (isset($data['image'])) {
                unset($data['image']);
            }

            // validate input data
            $model->validate();

            // add data to model object
            $model->addData($data);

            // get core session object
            $session = Mage::getSingleton('core/session');

            try {
                /* @var $imageHelper Ab_Adverboard_Helper_Image */
                $imageHelper = Mage::helper('ab_adverboard/image');

                //upload new image
                $imageFile = $imageHelper->uploadImage('image');
                if ($imageFile) {
                    if ($model->getImage()) {
                        $imageHelper->removeImage($model->getImage());
                    }
                    $model->setImage($imageFile);
                }

                // add data to model object from $_SERVER variable
                $model->setAuthor_ip($_SERVER['REMOTE_ADDR']);
                $model->setAuthor_browser($_SERVER['HTTP_USER_AGENT']);
                $model->setAuthor_country($_SERVER['GEOIP_COUNTRY_CODE'] ? $_SERVER['GEOIP_COUNTRY_CODE'] : null);

                // save the data
                $model->save();

                //display success message
                $session->addSuccess(
                    Mage::helper('ab_adverboard')->__('The advert item has been saved.')
                );

            } catch (Mage_Core_Exception $e) {
                // catch exception and add error to session
                $session->addError($e->getMessage());
            } catch (Exception $e) {
                // catch exception and add exception to session
                $session->addException($e,
                    Mage::helper('ab_adverboard')->__('An error occurred while saving the advert item.')
                );
            }

            // redirect to list page
            $this->_redirectReferer();
        }

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
