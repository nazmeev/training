<?php

namespace Training\FeedbackProduct\Controller\Form;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\LocalizedException;
use Training\Feedback\Api\FeedbackRepositoryInterface;
use Training\Feedback\Model\Feedback;

class Save___SSSS implements HttpPostActionInterface
{
    private FeedbackRepositoryInterface $feedbackRepository;

    private Context $context;

    public function __construct(
        FeedbackRepositoryInterface $feedbackRepository,
        Context $context
    )
    {
        $this->feedbackRepository = $feedbackRepository;
        $this->context = $context;
    }

    public function execute()
    {
        $result = $this->context->getResultRedirectFactory()->create();

        $post = $this->context->getRequest()->getPostValue();

            try {
                $this->validatePost($post);

                /**
                 * @var $feedback Feedback
                 */
                $feedback = $this->feedbackFactory->create();
                unset($post['id']);
                $feedback->setData($post);
                $this->setProductsToFeedback($feedback, $post);

                $this->feedbackRepository->save($feedback);
                $this->context->getMessageManager()->addSuccessMessage(
                    __('Thank you for your feedback.')
                );
            } catch (\Exception $e) {
                $this->context->getMessageManager()->addErrorMessage(
                    __('An error occurred while processing your form. Please try again later.')
                );
                $result->setPath('*/*/form');
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

    private function validatePost(array $post)
    {
        if (!isset($post['author_name']) || trim($post['author_name']) === '') {
            throw new LocalizedException(__('Name is missing'));
        }
        if (!isset($post['message']) || trim($post['message']) === '') {
            throw new LocalizedException(__('Comment is missing'));
        }

        if (!isset($post['author_email']) || false === \strpos($post['author_email'], '@')) {
            throw new LocalizedException(__('Invalid email address'));
        }
//        if (trim($this->getRequest()->getParam('hideit')) !== '') {
//            throw new \Exception();
//        }
    }
}
