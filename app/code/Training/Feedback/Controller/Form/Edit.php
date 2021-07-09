<?php

namespace Training\Feedback\Controller\Form;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\RequestInterface;

class Edit implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    private $pageResultFactory;
    private $modelFactory;
    private $resourceModel;

    public function __construct(
        PageFactory $pageResultFactory,
        RequestInterface $request,
        \Training\Feedback\Model\FeedbackFactory $modelFactory,
        \Training\Feedback\Model\ResourceModel\Feedback $resourceModel
    ) {
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $modelFactory;
        $this->request = $request;
        $this->pageResultFactory = $pageResultFactory;
    }

    /**
     * @return ResponseInterface|ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $modelToUpdate = $this->modelFactory->create();
//        $id = $this->getParamId();
        $this->resourceModel->load($modelToUpdate, 1);
//        $modelToUpdate->setData()
        print_r($modelToUpdate->getData());
        die;
    }

    private function getParamId(){
        return $this->request->getParam('id', false);
    }
}
