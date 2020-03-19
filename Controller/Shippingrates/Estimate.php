<?php
/**
 * EstimateRates
 *
 * @copyright Copyright © 2020 Landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */

namespace Lof\ShippingCalculator\Controller\Shippingrates;

use \Lof\ShippingCalculator\Helper\Data as LofData;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Quote\Model\QuoteFactory;
use Magento\Framework\Pricing\Helper\Data;

class Estimate extends Action
{
    /**
     * @var PageFactory
     */
    protected $product_repository;
    protected $quote;
    protected $pricingHelper;
    protected $helperData;

    /**
     * @param Context $context
     */
    public function __construct(Context $context, ProductRepositoryInterface $product_repository, QuoteFactory $quote, Data $pricingHelper, LofData $helperData)
    {
        $this->quote = $quote;
        $this->helperData = $helperData;
        $this->pricingHelper = $pricingHelper;
        $this->product_repository = $product_repository;
        parent::__construct($context);

    }

    /**
     * Index Action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $_params = $this->getRequest()->getParams();
        $storeId = isset($_params['storeId'])?$_params['storeId']:0;
        $response = [];
        if ($this->helperData->getEnable($storeId)) {
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
