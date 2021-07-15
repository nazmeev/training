<?php

namespace Training\FeedbackProduct\Controller\Form;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\ManagerInterface;
use Training\FeedbackProduct\Model\FeedbackDataLoader;
use Training\Feedback\Model\ResourceModel\Feedback as FeedbackResource;
use Training\Feedback\Model\FeedbackFactory;

class Save implements HttpPostActionInterface
{
    private $feedbackFactory;
    private $feedbackResource;
    private $feedbackDataLoader;
    private $request;
    private $resultRedirectFactory;
    private $messageManager;

    public function __construct(
        FeedbackFactory $feedbackFactory,
        FeedbackResource $feedbackResource,
        FeedbackDataLoader $feedbackDataLoader,
        RequestInterface $request,
        RedirectFactory $redirectFactory,
        ManagerInterface $messageManager
    )
    {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackResource = $feedbackResource;
        $this->feedbackDataLoader = $feedbackDataLoader;
        $this->request = $request;
        $this->resultRedirectFactory = $redirectFactory;
        $this->messageManager = $messageManager;
    }

    public function execute()
    {
        $result = $this->resultRedirectFactory->create();
        if ($post = $this->request->getPostValue()) {
            try {
                $this->validatePost($post);
                $feedback = $this->feedbackFactory->create();
                $feedback->setData($post);

                $this->setProductsToFeedback($feedback, $post);
                $this->feedbackResource->save($feedback);
                $this->messageManager->addSuccessMessage(
                    __('Thank you for your feedback.')
                );
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('An error occurred while processing your form. Please try again later. FeedbackProduct')
                );
                $result->setPath('*/*/form');
            }
        }
        $result->setPath('*/*/index');
        return $result;
    }

    private function setProductsToFeedback($feedback, $post)
    {
        $skus = [];
        if (isset($post['products_skus']) && !empty($post['products_skus'])) {
            $skus = explode(',', $post['products_skus']);
            $skus = array_map('trim', $skus);
            $skus = array_filter($skus);
        }
        $this->feedbackDataLoader->addProductsToFeedbackBySkus($feedback, $skus);
    }

    private function validatePost($post)
    {
        if (!isset($post['author_name']) || trim($post['author_name']) === '') {
            throw new LocalizedException(__('Name is missing'));
        }
        if (!isset($post['message']) || trim($post['message']) === '') {
            throw new LocalizedException(__('Comment is missing'));
        }
        if (!isset($post['products_skus']) || trim($post['products_skus']) === '') {
            throw new LocalizedException(__('sku is missing'));
        }

        if (!isset($post['author_email']) || false === \strpos($post['author_email'], '@')) {
            throw new LocalizedException(__('Invalid email address'));
        }
        if (trim($this->request->getParam('hideit')) !== '') {
            throw new \Exception();
        }
    }
}
