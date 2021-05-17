<?php

namespace Training\SubstituteCmsJson\Controller\Page;

use Magento\Cms\Helper\Page as PageHelper;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Cms\Api\PageRepositoryInterface;

class View implements HttpGetActionInterface, HttpPostActionInterface
{
    protected $resultFactory;
    protected $pageRepository;
    protected $request;
    private $pageHelper;

    public function __construct(
        PageHelper $pageHelper,
        Context $context,
        PageRepositoryInterface $pageRepository,
        RequestInterface $request
    )
    {
        $this->pageHelper = $pageHelper;
        $this->resultFactory = $context->getResultFactory();
        $this->request = $request;
        $this->pageRepository = $pageRepository;
    }

    /**
     * @return bool|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $pageId = $this->request->getParam('page_id', $this->request->getParam('id', false));

        if ($this->request->isAjax()) {
            $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
            $data = $this->setJsonData($pageId);

            $resultJson->setData($data);
            return $resultJson;
        }
        return $this->parentExecute($pageId);
    }

    private function setJsonData($pageId)
    {
        $data = ['status' => 'success', 'message' => ''];
        try {
            $page = $this->pageRepository->getById($pageId);
            $data['title'] = $page->getTitle();
            $data['content'] = $page->getContent();
        } catch (NoSuchEntityException $e) {
            $data['status'] = 'error';
            $data['message'] = 'Not found';
        } catch (\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = 'Something wrong';
        }
        return $data;
    }

    public function parentExecute($pageId)
    {
        $resultPage = $this->pageHelper->prepareResultPage($this, $pageId);
        return $resultPage;
    }


}
