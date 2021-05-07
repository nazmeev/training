<?php

namespace Training\SubstitutionGetUrlPlugin\Model;

class SubstitutionGetUrl
{
    public function beforeGetUrl(
        \Magento\Framework\UrlInterface $subject,
        $routePath = null,
        $routeParams = null
    ) {
//        echo 'beforeGetUrl'.$routePath."<br>";
        if ($routePath == 'customer/account/create') {
            return ['customer/account/login', null];
        }
    }
}
