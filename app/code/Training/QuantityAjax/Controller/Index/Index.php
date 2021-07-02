<?php

namespace Training\QuantityAjax\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use \Magento\CatalogInventory\Api\StockStateInterface;

class Index implements HttpPostActionInterface
{
    private $jsonResultFactory;

    public function __construct(
        JsonFactory $jsonFactory,
        StockStateInterface $stockItemRepository
    )
    {
        $this->jsonResultFactory = $jsonFactory;
        $this->stockItemRepository = $stockItemRepository;
    }

    public function execute()
    {
        $result = $this->jsonResultFactory->create();
        return $result->setData($this->getQtyProduct());
    }

    private function getQtyProduct(){
        $productId = 2;
        $stockItem = $this->stockItemRepository->getStockQty($productId);
        return [
            'qty' => $stockItem
        ];
    }
}
