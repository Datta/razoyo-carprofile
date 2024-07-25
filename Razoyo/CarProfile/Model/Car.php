<?php
namespace Razoyo\CarProfile\Model;

class Car
{
    private $apiCar;

    public function __construct(ApiCar $apiCar)
    {
        $this->apiCar = $apiCar;
    }

    public function getCarList()
    {
        $cars = $this->apiCar->getCarList();
        $formattedCars = [];
        foreach ($cars as $car) {
            $formattedCars[$car['id']] = [
                'name' => $car['year'] . ' ' . $car['make'] . ' ' . $car['model'],
                'image' => $car['image'] ?? '',
                'description' => $car['make'] . ' ' . $car['model'] . ' (' . $car['year'] . ')'
            ];
        }
        return $formattedCars;
    }

    public function getCarInfo($carId)
    {
        $car = $this->apiCar->getCarInfo($carId);
        if (!array_key_exists("id",$car)) {
            return null;
        }else{
            return [
                'name' => $car['year'] . ' ' . $car['make'] . ' ' . $car['model'],
                'image' => $car['image'] ?? '',
                'description' => "Make: {$car['make']}, Model: {$car['model']}, Year: {$car['year']}, Price: \${$car['price']}, Seats: {$car['seats']}, MPG: {$car['mpg']}"
            ];
        }
    }
}