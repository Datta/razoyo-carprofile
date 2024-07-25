<?php
/**
 * Razoyo
 *
 * @category  Razoyo
 * @package   razoyo/carprofile
 * @version   1.0.0
 * 
 */
namespace Razoyo\CarProfile\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;
use Razoyo\CarProfile\Model\Car;

class CarProfile extends Template
{
    private $customerSession;
    private $carModel;

    public function __construct(
        Template\Context $context,
        Session $customerSession,
        Car $carModel,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->carModel = $carModel;
    }

    public function getCustomer()
    {
        return $this->customerSession->getCustomer();
    }

    public function getCarList()
    {
        return $this->carModel->getCarList();
    }

    public function getSelectedCar()
    {
        $carId = $this->getCustomer()->getCarModel();
        return $carId ? $this->carModel->getCarInfo($carId) : null;
    }

    public function hasCarList()
    {
        return !empty($this->getCarList());
    }

    public function getSelectedCarId()
    {
        return $this->getCustomer()->getCarModel();
    }
}