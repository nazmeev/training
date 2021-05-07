<?php

namespace Training\SubstitutionRegisterUrlPlugin\Model;

use Magento\Framework\UrlInterface;

class SubstitutionRegistrationUrl
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    public function aftergetRegisterUrl(
        \Magento\Customer\Model\Url $subject
    ) {
//        echo "aftergetRegisterUrl";
        return $this->urlBuilder->getUrl('customer/account');
    }
}
