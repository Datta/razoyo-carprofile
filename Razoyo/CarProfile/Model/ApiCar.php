<?php
/**
 * Razoyo
 *
 * @category  Razoyo
 * @package   razoyo/carprofile
 * @version   1.0.0
 * 
 */
namespace Razoyo\CarProfile\Model;

use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;

class ApiCar
{
	// Api enpoint base url. i would add it in the system module configuration. 
    private const API_BASE_URL = 'https://exam.razoyo.com/api';
    private $curl;
    private $json;

    public function __construct(Curl $curl, Json $json)
    {
        $this->curl = $curl;
        $this->json = $json;
    }

    public function getCarList($make = null)
    {
        try {
            $url = self::API_BASE_URL . '/cars';
            if ($make) {
                $url .= '?make=' . urlencode($make);
            }

            $this->curl->get($url);
			// get car list from api
            $response = $this->curl->getBody();
            $data = $this->json->unserialize($response);

            return $data['cars'] ?? [];
        } catch (\Exception $e) {
            // Error can handled here
            return [];
        }
    }

    public function getCarInfo($carId)
    {
        try {
            $url = self::API_BASE_URL . '/cars/' . $carId;
            $this->curl->get($url);
			// get car info from api
            $response = $this->curl->getBody();
            return $this->json->unserialize($response);
        } catch (\Exception $e) {
            // Error can handled here
            return null;
        }
    }
}