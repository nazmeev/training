<?php

namespace Training\Feedback\Controller\Form;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    private $pageResultFactory;

    public function __construct(
        PageFactory $pageResultFactory
    ) {
        $this->pageResultFactory = $pageResultFactory;
    }

    /**
     * @return ResponseInterface|ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return  $this->pageResultFactory->create();
    }
}
