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

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save implements HttpPostActionInterface
{
    private $request;
    private $customerSession;
    private $messageManager;
    private $resultRedirectFactory;

    public function __construct(
        RequestInterface $request,
        Session $customerSession,
        ManagerInterface $messageManager,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->request = $request;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        $carId = $this->request->getParam('car_model');
        $customer = $this->customerSession->getCustomer();
        $customer->setCarModel($carId);
        $customer->save();

        $this->messageManager->addSuccessMessage(__('Your car profile has been updated.'));

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('carprofile/account/index');
    }
}