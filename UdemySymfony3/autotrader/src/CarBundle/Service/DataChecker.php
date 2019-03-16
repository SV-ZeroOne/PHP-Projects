<?php

namespace CarBundle\Service;

use CarBundle\Entity\Car;
use Doctrine\ORM\EntityManager;

class DataChecker
{
    /** @var boolean */
    protected $requireImagesToPromoteCar;

    /** @var EntityManager */
    protected $entityManager;

    public function __construct($entityManager, $requireImagesToPromoteCar)
    {   
        $this->entityManager = $entityManager;
        $this->requireImagesToPromoteCar = $requireImagesToPromoteCar;
    }

    public function checkCar(Car $car)
    {
        //return "Car" . $car->getModel() . " checked";
        $promote = true;
        if($this->requireImagesToPromoteCar)
        {
            $promote = false;
        }
        $car->setPromote($promote);
        $this->entityManager->persist($car);
        $this->entityManager->flush();
        return true;
    }
}

?>