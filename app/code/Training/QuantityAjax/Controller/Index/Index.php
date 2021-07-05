<?php

namespace Training\QuantityAjax\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\CatalogInventory\Api\StockStateInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class Index implements HttpPostActionInterface
{
    private $jsonResultFactory;
    private $request;
    private $product;
    private $_productRepository;

    public function __construct(
        JsonFactory $jsonFactory,
        StockStateInterface $stockItemRepository,
        RequestInterface $request,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->jsonResultFactory = $jsonFactory;
        $this->stockItemRepository = $stockItemRepository;
        $this->request = $request;
        $this->_productRepository = $productRepository;
    }

    public function execute()
    {
        return $this->jsonResultFactory->create()->setData($this->getQtyProduct());
    }

    private function getQtyProduct(){

        $productId = $this->getParam_ProductId();

        if(!$productId){
            return $this->errorResult();
        }

        $this->getProductById($productId);

        if(!$this->isSimpleProduct()){
            return $this->errorResult();
        }

        $stockItem = $this->stockItemRepository->getStockQty($productId);

        return [
            'qty' => $stockItem
        ];
    }

    private function isSimpleProduct(){
        return $this->product->getTypeId() === 'simple';
    }

    private function getParam_ProductId(){
        return $this->request->getParam('productId', false);
    }

    private function getProductById($productId){
        $this->product = $this->_productRepository->getById($productId);
    }

    private function errorResult(){
        return [
            'qty' => null
        ];
    }

}
