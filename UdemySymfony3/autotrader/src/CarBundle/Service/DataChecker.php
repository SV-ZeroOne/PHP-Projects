<?php

namespace CarBundle\Service;

use CarBundle\Entity\Car;
use Doctrine\ORM\EntityManager;

class DataChecker
{
    /** @var boolean */
    protected $requiredImagesToPromoteCar;

    /** @var EntityManager */
    protected $entityManager;

    public function __construct($entityManager, $requiredImagesToPromoteCar)
    {   
        $this->entityManager = $entityManager;
        $this->requiredImagesToPromoteCar = $requiredImagesToPromoteCar;
    }

    public function checkCar(Car $car)
    {
        //return "Car" . $car->getModel() . " checked";
        $promote = true;
        if($this->requiredImagesToPromoteCar)
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