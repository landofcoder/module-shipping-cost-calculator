<?php
/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_ShippingCalculator
 * @copyright  Copyright (c) 2021 Landofcoder (https://landofcoder.com/)
 * @license    https://landofcoder.com/LICENSE-1.0.html
 */

namespace Lof\ShippingCalculator\Model\Data;

use Lof\ShippingCalculator\Api\Data\RequestRateInterface;

class RequestRate extends \Magento\Framework\Api\AbstractExtensibleObject implements RequestRateInterface
{
    /**
     * {@inheritdoc}
     */
    public function getProductId()
    {
        return $this->_get(self::PRODUCT_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setProductId($product_id)
    {
        return $this->setData(self::PRODUCT_ID, $product_id);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductSku()
    {
        return $this->_get(self::PRODUCT_SKU);
    }

    /**
     * {@inheritdoc}
     */
    public function setProductSku($product_sku)
    {
        return $this->setData(self::PRODUCT_SKU, $product_sku);
    }

    /**
     * {@inheritdoc}
     */
    public function getCountryId() 
    {
        return $this->_get(self::COUNTRY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setCountryId($country_id)
    {
        return $this->setData(self::COUNTRY_ID, $country_id);
    }

    /**
     * {@inheritdoc}
     */
    public function getRegionId()
    {
        return $this->_get(self::REGION_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setRegionId($region_id)
    {
        return $this->setData(self::REGION_ID, $region_id);
    }

    /**
     * {@inheritdoc}
     */
    public function getRegion()
    {
        return $this->_get(self::REGION);
    }

    /**
     * {@inheritdoc}
     */
    public function setRegion($region)
    {
        return $this->setData(self::REGION, $region);
    }

    /**
     * {@inheritdoc}
     */
    public function getPostcode()
    {
        return $this->_get(self::POSTCODE);
    }

    /**
     * {@inheritdoc}
     */
    public function setPostcode($postcode)
    {
        return $this->setData(self::POSTCODE, $postcode);
    }

    /**
     * {@inheritdoc}
     */
    public function getQty()
    {
        return $this->_get(self::QTY);
    }

    /**
     * {@inheritdoc}
     */
    public function setQty($qty)
    {
        return $this->setData(self::QTY, $qty);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductOptions()
    {
        return $this->_get(self::PRODUCT_OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function setProductOptions($product_options)
    {
        return $this->setData(self::PRODUCT_OPTIONS, $product_options);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     */
    public function setExtensionAttributes(
        \Lof\ShippingCalculator\Api\Data\RequestRateExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}

