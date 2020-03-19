<?php
/**
 * Index
 *
 * @copyright Copyright © 2020 Landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */
namespace Lof\ShippingCalculator\Block\Widget;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Lof\ShippingCalculator\Helper\Data;
use Magento\Catalog\Block\Product\View;


class ShippingCalculator extends Template implements BlockInterface
{
    protected $_template="widget/shippingcalculator.phtml";

    protected $helperData;
    protected $product_view;

    /**
     * ShippingCalculator constructor.
     * @param Template\Context $context
     * @param array $data
     * @param Data $helperData
     * @param View $product_view
     */

    public function __construct(Template\Context $context, Data $helperData, view $product_view)
    {
        parent::__construct($context);
        $this->helperData = $helperData;
        $this->product_view = $product_view;
    }

    /**
     * @return mixed
     */
    public function getProductInfo()
    {
        return $this->product_view->getProduct();
    }

    /**
     * @return string|void
     */
    protected function _toHtml()
    {
        if ($this->helperData->getEnable() == 0) {
            return;
        }
        return parent::_toHtml();
    }
}
