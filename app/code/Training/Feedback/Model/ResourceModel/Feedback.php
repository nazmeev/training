<?php

namespace Training\Feedback\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Feedback extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'training_feedback_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('training_feedback', 'feedback_id');
        $this->_useIsObjectNew = true;
    }
}
