<?php
/**
 * Copyright © Landofcoder All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\ShippingCalculator\Api\Data;

interface RequestRateInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const PRODUCT_ID = 'product_id';
    const PRODUCT_SKU = 'product_sku';
    const COUNTRY_ID = 'country_id';
    const REGION_ID = 'region_id';
    const REGION = 'region';
    const POSTCODE = 'postcode';
    const QTY = 'qty';
    const PRODUCT_OPTIONS = 'product_options';

    /**
     * Get product_id
     * @return int|null
     */
    public function getProductId();

    /**
     * Set product_id
     * @param int $product_id
     * @return \Lof\ShippingCalculator\Api\Data\RequestRateInterface
     */
    public function setProductId($product_id);

    /**
     * Get product_sku
     * @return string|null
     */
    public function getProductSku();

    /**
     * Set product_sku
     * @param string $product_sku
     * @return \Lof\ShippingCalculator\Api\Data\RequestRateInterface
     */
    public function setProductSku($product_sku);

    /**
     * Get country_id
     * @return string|null
     */
    public function getCountryId();

    /**
     * Set country_id
     * @param string $country_id
     * @return \Lof\ShippingCalculator\Api\Data\RequestRateInterface
     */
    public function setCountryId($country_id);

    /**
     * Get region_id
     * @return string|null
     */
    public function getRegionId();

    /**
     * Set region_id
     * @param string $region_id
     * @return \Lof\ShippingCalculator\Api\Data\RequestRateInterface
     */
    public function setRegionId($region_id);

    /**
     * Get region
     * @return string|null
     */
    public function getRegion();

    /**
     * Set region
     * @param string $region
     * @return \Lof\ShippingCalculator\Api\Data\RequestRateInterface
     */
    public function setRegion($region);

    /**
     * Get postcode
     * @return string|null
     */
    public function getPostcode();

    /**
     * Set postcode
     * @param string $postcode
     * @return \Lof\ShippingCalculator\Api\Data\RequestRateInterface
     */
    public function setPostcode($postcode);

    /**
     * Get qty
     * @return float|int|null
     */
    public function getQty();

    /**
     * Set qty
     * @param float|int $qty
     * @return \Lof\ShippingCalculator\Api\Data\RequestRateInterface
     */
    public function setQty($qty);

    /**
     * Get product_options
     * @return string|null
     */
    public function getProductOptions();

    /**
     * Set product_options
     * @param string $product_options
     * @return \Lof\ShippingCalculator\Api\Data\RequestRateInterface
     */
    public function setProductOptions($product_options);

    
    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Lof\ShippingCalculator\Api\Data\RequestRateExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Lof\ShippingCalculator\Api\Data\RequestRateExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Lof\ShippingCalculator\Api\Data\RequestRateExtensionInterface $extensionAttributes
    );
}