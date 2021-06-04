<?php

namespace Training\Rendering\Block;

use Magento\Backend\Block\AbstractBlock;

class HtmlBlock extends AbstractBlock
{
    public function _toHtml():string
    {
        return "Hello world2";
    }
}

