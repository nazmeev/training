<?php

namespace Training\Feedback\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Training\Feedback\Api\Data\FeedbackRepositoryInterface;
use Training\Feedback\Model\FeedbackFactory;

class Save extends Action
{
    const ADMIN_RESOURCE = 'Training_Feedback::feedback_save';
    private $dataPersistor;
    private $feedbackRepository;
    private $feedbackFactory;
    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param FeedbackRepositoryInterface $feedbackRepository
     * @param FeedbackFactory $feedbackFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        FeedbackRepositoryInterface $feedbackRepository,
        FeedbackFactory $feedbackFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->feedbackRepository = $feedbackRepository;
        $this->feedbackFactory = $feedbackFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Feedback::STATUS_ACTIVE;
            }
            if (empty($data['feedback_id'])) {
                $data['feedback_id'] = null;
            }
            $model = $this->feedbackFactory->create();
            $id = $this->getRequest()->getParam('feedback_id');
            if ($id) {
                try {
                    $model = $this->feedbackRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This feedback no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $model->setData($data);
            try {
                $this->feedbackRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the feedback.'));
                $this->dataPersistor->clear('training_feedback');
                return $this->processRedirect($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager
                    ->addExceptionMessage($e, __('Something went wrong while saving the feedback.'));
            }
            $this->dataPersistor->set('training_feedback', $data);
            return $resultRedirect->setPath(
                '*/*/edit',
                ['feedback_id' => $this->getRequest()->getParam('feedback_id')]
            );
        }
        return $resultRedirect->setPath('*/*/');
    }
    private function processRedirect($model, $data, $resultRedirect)
    {
        $redirect = $data['back'] ?? 'close';
        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['feedback_id' => $model->getId()]);
        } else if ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        }
        return $resultRedirect;
    }
}
