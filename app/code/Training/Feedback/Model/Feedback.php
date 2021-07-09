<?php

namespace Training\Feedback\Model;

use Magento\Framework\Model\AbstractModel;
use Training\Feedback\Model\ResourceModel\Feedback as ResourceModel;

class Feedback extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'training_feedback_model';

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
