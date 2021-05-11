<?php

namespace Training\RedirectUnloggedProductPlugin\Controller;

class View
{
    private $customerSession;
    private $redirectFactory;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
    )
    {
        $this->customerSession = $customerSession;
        $this->redirectFactory = $redirectFactory;
    }

    public function aroundExecute(
        \Magento\Catalog\Controller\Product\View $subject,
        \Closure $proceed
    )
    {
//        echo 'Training\RedirectUnloggedProductPlugin\Controller\aroundExecute';
        if (!$this->customerSession->isLoggedIn()) {
            return $this->redirectFactory->create()->setPath('customer/account/login');
        }
        return $proceed();
    }
}
