<?php

namespace Training\RenderSimpletextController\Controller\Page;
class Index implements \Magento\Framework\App\ActionInterface
{
    private $resultFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context
    )
    {
        $this->resultFactory = $context->getResultFactory();
    }

    public function execute()
    {
        $resultRaw = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_RAW);
        $resultRaw->setContents('simple text2');
        return $resultRaw;
    }
}
