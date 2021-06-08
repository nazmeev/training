<?php

namespace Training\Rendering\Plugin\Block\Product\View;

class Description
{
    public function beforeToHtml(
        \Magento\Catalog\Block\Product\View\Description $subject
    )
    {
//        $subject->getProduct()->setData('description', 'Test description');
        if ($subject->getNameInLayout() == 'product.info.sku')
            $subject->setTemplate('Training_Rendering::description.phtml');
    }
}
