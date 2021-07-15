<?php

namespace Training\Feedback\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;
use Training\Feedback\Api\Data\FeedbackRepositoryInterface;
use Training\Feedback\Model\FeedbackFactory;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Training_Feedback::feedback_save';
    private $resultPageFactory;
    private $feedbackRepository;
    private $feedbackFactory;

    /**
     * @param PageFactory $resultPageFactory
     * @param FeedbackRepositoryInterface $feedbackRepository
     * @param FeedbackFactory $feedbackFactory
     */
    public function __construct(
        PageFactory $resultPageFactory,
        FeedbackRepositoryInterface $feedbackRepository,
        FeedbackFactory $feedbackFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->feedbackRepository = $feedbackRepository;
        $this->feedbackFactory = $feedbackFactory;
    }
    /**
     * @return ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('feedback_id');
        $model = $this->feedbackFactory->create();
        if ($id) {
            try {
                $model = $this->feedbackRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This feedback no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage
            ->setActiveMenu('Training_Feedback::feedback')
            ->addBreadcrumb(__('Feedbacks'), __('Feedbacks'))
            ->addBreadcrumb(
                $id ? __('Edit Feedback') : __('New Feedback'),
                $id ? __('Edit Feedback') : __('New Feedback')
            );
        return $resultPage;
    }
}
