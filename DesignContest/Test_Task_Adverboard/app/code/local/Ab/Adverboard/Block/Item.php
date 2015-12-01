<?php
/*
*  Advert Item Block
 *
 * @author Oleg Khuda
 */

class Ab_Adverboard_Block_Item extends Mage_Core_Block_Template
{
    /*
     * Current Advert Item instance
     *
     * @var Ab_Adverboard_Model_Adverboard
     * */
    protected $_item;

    /* Return parameters for back url
    *
     *  @param array $additionalParams
     *  @return array
    */
    protected function _getBackUrlQueryParams($additionalParams = array())
    {
        return array_merge(array('p' => $this->getPage()), $additionalParams);
    }

    /* Return URL to the advert list page
    *
     * @return string
     * */
    public function getBackUrl()
    {
        return $this->getUrl('*/', array('_query' => $this->_getBackUrlQueryParams()));
    }

    /* Return URL for resized advert Item image
    *
     * @param Ab_Adverboard_Model_Adverboard $item
     * @param integer $width
     * @return string|false
     * */
    public function getImageUrl($item, $width)
    {
        return Mage::helper('ab_adverboard/image')->resize($item, $width);
    }
}
