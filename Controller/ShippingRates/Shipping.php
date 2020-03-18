<?php
/**
 * Shipping
 *
 * @copyright Copyright © 2020 Landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */
namespace Lof\ShippingCalculator\Controller\ShippingRates;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Lof\ShippingCalculator\Helper\Data as ShippingData;
use Magento\Framework\Pricing\Helper\Data;
use Magento\Quote\Model\QuoteFactory;

class Shipping extends Action
{
    protected $product_Repository;
    protected $quote;
    protected $pricingHelper;
    protected $helperData;

    /**
     * @param Context $context
     * @param QuoteFactory $quote
     * @param ProductRepositoryInterface $product_Repository
     * @param Data $pricingHelper
     * @param ShippingData $helperData
     */
    public function __construct(
        Context $context,
        QuoteFactory $quote,
        ProductRepositoryInterface $product_Repository,
        Data $pricingHelper,
        ShippingData $helperData
    ) {
        parent::__construct($context);
        $this->quote = $quote;
        $this->product_Repository = $product_Repository;
        $this->pricingHelper = $pricingHelper;
        $this->helperData = $helperData;
    }

    /**
     * Index Action
     *
     * @return \Magento\Framework\View\Result\Page
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function execute()
    {
        $_params = $this->getRequest()->getParams();
        $storeId = isset($_params['storeId'])?$_params['storeId']:0;
        $response = [];
        if ($this->helperData->getGeneralConfig($storeId)) {
            if (
                empty($_params) || !isset($_params['cep']) || $_params['cep'] == "") {
                $response['error']['message'] = __('Postcode not informed');
            } elseif (
                !isset($_params['product']) ||
                $_params['product'] == ""||
                $_params['product'] == 0 ||
                !is_numeric($_params['product'])
            ) {
                $response['error']['message'] = __('Amount reported is invalid');
            }

            if (!isset($response['error'])) {
                if (
                    !isset($_params['qty']) ||
                    $_params['qty'] == ""||
                    $_params['qty'] == 0 ||
                    !is_numeric($_params['qty'])
                ) {
                    $qty = 1;
                } else {
                    $qty = $_params['qty'];
                }

                try {
                    $_product = $this->product_repository->getById($_params['product']);
                    $default_country_id = $this->helperData->getDefaultCountryCode($storeId);
                    $quote = $this->quote->create();
                    $quote->addProduct($_product, $qty);
                    $quote->getShippingAddress()->setCountryId($default_country_id);
                    $quote->getShippingAddress()->setPostcode($_params['cep']);
                    $quote->getShippingAddress()->setCollectShippingRates(true);
                    $quote->getShippingAddress()->collectShippingRates();
                    $rates = $quote->getShippingAddress()->getShippingRatesCollection();

                    if (count($rates)>0) {
                        $shipping_methods = [];

                        foreach ($rates as $rate) {
                            $_message = !$rate->getErrorMessage() ? "" : $rate->getErrorMessage();
                            $shipping_methods[$rate->getCarrierTitle()][] = array(
                                'title' => $rate->getMethodTitle(),
                                'price' => $this->pricingHelper->currency($rate->getPrice()),
                                'message' => $_message,
                            );
                        }

                        $response = $shipping_methods;
                    } else {
                        $response['error']['message'] = __('There is no shipping method available at this time.');
                    }
                } catch (\Exception $e) {
                    $response['error']['message'] = $e->getMessage();
                    echo json_encode($response, true);
                    exit;
                }
            }
        }
        echo json_encode($response, true);
        exit;
    }
}
