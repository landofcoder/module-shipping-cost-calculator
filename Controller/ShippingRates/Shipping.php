<?php
/**
 * Shipping
 *
 * @copyright Copyright © 2020 Landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */
namespace Lof\ShippingCalculator\Controller\ShippingRates;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Cart;
use Magento\Checkout\Model\Session;

class Shipping extends Action
{
    protected $_cart;
    protected $_checkoutSession;
    /**
     * @var PageFactory
     */
    protected $pageFactory;

    protected $scopeConfig;

    protected $shipconfig;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        cart $cart,
        session $checkoutSession,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Shipping\Model\Config $shipconfig
    ) {
        $this->pageFactory = $pageFactory;
        $this->_cart = $cart;
        $this->_checkoutSession = $checkoutSession;
        $this->shipconfig=$shipconfig;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * Index Action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function getCart()
    {
        return $this->_cart;
    }
    public function getCheckoutSession()
    {
        return $this->_checkoutSession;
    }

    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
        $shippingAddress = $cart->getQuote()->getShippingAddress();

        $quote = $this->_checkoutSession->getQuote();
        $address = $quote->getShippingAddress();
        $collectRates = $address->collectShippingRates();

        $methods = [];
        $activeCarriers = $this->shipconfig->getActiveCarriers();
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        foreach ($activeCarriers as $carrierCode => $carrierModel) {
            $options = array();
            if ($carrierMethods = $carrierModel->getAllowedMethods()) {
                foreach ($carrierMethods as $methodCode => $method) {
                    $code= $carrierCode.'_'.$methodCode;
                    $options[]=array('value'=>$code,'label'=>$method);
                }
                $carrierTitle =$this->scopeConfig->getValue('carriers/'.$carrierCode.'/title');
            }
            $methods[]=array('value'=>$options,'label'=>$carrierTitle);
        }

        var_dump($methods);
        die;

        $quote = $this->checkoutSession->getQuote();
        $address = $quote->getShippingAddress();
        $address->collectShippingRates();

        echo '<pre>';
        print_r($shippingAddress->getData());
        echo '</pre>';
        die();



        $shippingAddress = $this->cart->getQuote()->getShippingAddress();

        $street = $shippingAddress->getData('street');
        $city = $shippingAddress->getData('city');
        $countryCode = $shippingAddress->getData('country_id');
        $postCode = $shippingAddress->getData('postcode');
        $region = $shippingAddress->getData('region');
        $telephone = $shippingAddress->getData('telephone');
        $email = $shippingAddress->getData('email');

        echo $email;
        die();


        // you can also get Shipping Method from shipping address
        $shippingMethod = $shippingAddress->getShippingMethod();

        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        $resultJson->setData($shippingAddress);
        return  $resultJson;
    }
}
