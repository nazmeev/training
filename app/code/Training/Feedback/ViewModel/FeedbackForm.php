<?php

namespace Training\Feedback\ViewModel;

class FeedbackForm
{
    public function getActionUrl()
    {
        return $this->urlBuilder->getUrl('training_feedback/index/save');
    }
}
