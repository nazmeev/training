<?php

namespace Training\Feedback\Api;

use Training\Feedback\Api\Data\FeedbackInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

interface FeedbackRepositoryInterface
{
    /**
     * Save feedback.
     *
     * @param FeedbackInterface $feedback
     * @return FeedbackInterface
     * @throws LocalizedException
     */
    public function save(FeedbackInterface $feedback);

    /**
     * Retrieve feedback.
     *
     * @param int $feedbackId
     * @return FeedbackInterface
     * @throws LocalizedException
     */
    public function getById($feedbackId);
    /**
     * Retrieve feedbacks matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Training\Feedback\Api\Data\FeedbackSearchResultsInterface
     * @throws LocalizedException
     */

    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete feedback.
     *
     * @param FeedbackInterface $feedback
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(FeedbackInterface $feedback);

    /**
     * Delete feedback by ID.
     *
     * @param int $feedbackId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($feedbackId);
}
