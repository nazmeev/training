<?php

namespace Training\InjectionTestOM\Controller\Index;
use Training\TestOM\Model\PlayWithTest;

class Index implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    private $test;

    public function __construct(
        PlayWithTest $test
    ) {
        $this->test = $test;
    }

    public function execute()
    {
        $this->test->run();
        exit();
    }
}
