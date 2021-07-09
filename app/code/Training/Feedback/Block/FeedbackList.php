<?php

namespace Training\Feedback\Block;

class FeedbackList extends \Magento\Framework\View\Element\Template
{
    const PAGE_SIZE = 5;
    private $collectionFactory;
    private $collection;
    private $timezone;
    private $resource;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory $collectionFactory,
        \Magento\Framework\Stdlib\DateTime\Timezone $timezone,
        array $data = array(),
        \Training\Feedback\Model\ResourceModel\Feedback $resource
    )
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->timezone = $timezone;
        $this->resource = $resource;
    }

    public function getCollection()
    {
        if (!$this->collection) {
            $this->collection = $this->collectionFactory->create();
            $this->collection->addFieldToFilter('is_active', 1);
            $this->collection->setOrder('creation_time', 'DESC');
        }
        return $this->collection;
    }

    public function getPagerHtml()
    {
        $pagerBlock = $this->getChildBlock('feedback_list_pager');
        if ($pagerBlock instanceof \Magento\Framework\DataObject) {
            /* @var $pagerBlock \Magento\Theme\Block\Html\Pager */
            $pagerBlock
                ->setUseContainer(false)
                ->setShowPerPage(false)
                ->setShowAmounts(false)
                ->setLimit($this->getLimit())
                ->setCollection($this->getCollection());
            return $pagerBlock->toHtml();
        }
        return '';
    }

    public function getLimit()
    {
        return static::PAGE_SIZE;
    }

    public function getAddFeedbackUrl()
    {
        return $this->getUrl('training_feedback/form/index');
    }

    public function getFeedbackDate($feedback)
    {
        return $this->timezone->formatDateTime($feedback->getCreationTime());

    }

    public function getAllFeedbackNumber(){
        return $this->resource->getAllFeedbackNumber();
    }
    public function getActiveFeedbackNumber(){
        return $this->resource->getActiveFeedbackNumber();
    }

}
