<?php

namespace Training\QuantityAjax\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class CurrentProduct implements ArgumentInterface
{
    private $registry;
    private $product;

    public function __construct(
        \Magento\Framework\Registry $registry
    )
    {
        $this->registry = $registry;

        $this->product = $this->getCurrentProduct();
    }

    public function getProductId()
    {
        return $this->product->getId();
    }

    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }
}
