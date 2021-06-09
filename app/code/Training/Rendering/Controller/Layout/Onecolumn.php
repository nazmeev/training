<?php

namespace Training\Rendering\Controller\Layout;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\LayoutFactory;

class Onecolumn implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    private $layoutFactory;
    private $resultFactory;

    public function __construct(
        ResultFactory $resultFactory
    )
    {
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

