<?php

namespace Training\Feedback\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Training_Feedback::feedback';
    private $resultPageFactory;
    private $dataPersistor;
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DataPersistorInterface $dataPersistor
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }
    /**
     * Index action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage
            ->setActiveMenu('Training_Feedback::feedback')
            ->addBreadcrumb(__('Feedbacks'), __('Feedbacks'))
            ->getConfig()->getTitle()->prepend(__('Feedback'));
        $this->dataPersistor->clear('training_feedback');
        return $resultPage;
    }
}
