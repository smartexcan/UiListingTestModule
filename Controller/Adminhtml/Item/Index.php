<?php
declare(strict_types=1);

namespace Author\Example\Controller\Adminhtml\Item;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Backend\App\Action;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Author_Example::items';

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Author_Example::example')
            ->addBreadcrumb(__('Example Items'), __('Example Items'));
        $resultPage->getConfig()->getTitle()->prepend(__('Example Items'));

        return $resultPage;
    }
}
