<?php
namespace Lof\ShippingCalculator\Controller\Shippingrates;

use Magento\Directory\Model\RegionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class Country extends Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;
    protected $resultJsonFactory;
    protected $regionColFactory;
    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        JsonFactory $resultJsonFactory,
        RegionFactory $regionColFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->regionColFactory = $regionColFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    /**
     * Index Action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();

        $result           = $this->resultJsonFactory->create();
        $regions=$this->regionColFactory->create()->getCollection()->addFieldToFilter('country_id', $this->getRequest()->getParam('country'));

        $html = '';

        if (count($regions) > 0) {
            $html.='<option selected="selected" value="">Please select a region, state or province.</option>';
            foreach ($regions as $state) {
                $html.= '<option  value="'.$state->getName().'">'.$state->getName().'.</option>';
            }
        }
        return $result->setData(['success' => true,'value'=>$html]);
    }
}
