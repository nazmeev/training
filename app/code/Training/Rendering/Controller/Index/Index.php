<?php

namespace Training\Rendering\Controller\Index;

use Magento\Framework\View\LayoutFactory;

class Index implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    private $layoutFactory;

    public function __construct(
        LayoutFactory $layoutFactory
    ) {
        $this->layoutFactory = $layoutFactory;
    }

    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock('Training\Rendering\Block\HtmlBlock');
        echo $block->toHtml(); die;
    }
}
