<?php

namespace Training\QuantityAjax\ViewModel;

use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CurrentProduct implements ArgumentInterface
{
    public function __construct()
    {
    }

    /**
     * @param Product $product
     * @return int
     */
    public function getProductId(Product $product): int
    {
        return $product->getId();
    }

}
