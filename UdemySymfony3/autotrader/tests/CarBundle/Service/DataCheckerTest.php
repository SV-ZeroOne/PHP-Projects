<?php

namespace CarBundle\Service;

use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class DataCheckerTest extends TestCase
{
    /** @var EntityManager|\PHpUnit_Framework_MockObject_MockObject */
    protected $entityManager;
    public function setup()
    {
        $this->entityManager = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->getMock();
    }

    public function testChechCarWithRequiredPhotosWillReturnFalse()
    {
        $subject = new DataChecker($this->entityManager, true);
        $expectedResult = false;
        $car = $this->getMock('CarBundle\Entity\Car');
        $car->expects($this->once())
            ->method('setPromote')
            ->with($expectedResult);

        $this->entityManager->expects($this->once())
             ->method('persist')
             ->with($car);
        $this->entityManager->expects($this->once())
             ->flush();
        $result = $subject->checkCar($car);
        $this->assertEqualt($expectedResult, $result);
    }
}