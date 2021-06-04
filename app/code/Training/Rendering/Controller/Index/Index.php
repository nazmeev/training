<?php

namespace Training\Rendering\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\LayoutFactory;

class Index implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    private $layoutFactory;
    private $resultFactory;

    public function __construct(
        LayoutFactory $layoutFactory,
        ResultFactory $resultFactory
    )
    {
        $this->layoutFactory = $layoutFactory;
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock('Training\Rendering\Block\HtmlBlock');
        $data = $block->toHtml();
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        return $result->setContents($data);
    }
}
