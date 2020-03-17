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

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory, cart $cart, session $checkoutSession, array $data = [])
    {
        $this->pageFactory = $pageFactory;
        $this->_cart = $cart;
        $this->_checkoutSession = $checkoutSession;
        parent::__construct($context, $data);
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

        echo $email; die();


        // you can also get Shipping Method from shipping address
        $shippingMethod = $shippingAddress->getShippingMethod();

        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        $resultJson->setData($shippingAddress);
        return  $resultJson;
    }
}
