<?php
/**
 * Razoyo
 *
 * @category  Razoyo
 * @package   razoyo/carprofile
 * @version   1.0.0
 * 
 */
namespace Razoyo\CarProfile\Controller\Account;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    private $resultPageFactory;

    public function __construct(PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('My Car Profile'));
        return $resultPage;
    }
}