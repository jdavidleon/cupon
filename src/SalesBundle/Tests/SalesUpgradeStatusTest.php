<?php
/**
 * Created by PhpStorm.
 * User: jlp25
 * Date: 3/11/2018
 * Time: 10:29 PM
 */

namespace SalesBundle\Tests;

use Doctrine\ORM\EntityManagerInterface;
use SalesBundle\Entity\SalesUpgradeStatus;
use SalesBundle\Repository\SalesUpgradeStatusRepository;
use SalesBundle\Service\ChangeUploadSale;

class SalesUpgradeStatusTest extends \PHPUnit_Framework_TestCase
{

    private $entityManager;

    private $changeStatusSale;

    private $salesUpgradeStatusRepository;

    /**
     *
     */
    protected function setUp()
    {
        $this->entityManager = $this->prophesize(EntityManagerInterface::class);
        $this->salesUpgradeStatusRepository = $this->prophesize(SalesUpgradeStatusRepository::class);

        $this->changeStatusSale = new ChangeUploadSale(
            $this->entityManager->reveal(),
            $this->salesUpgradeStatusRepository->reveal()

        );
    }


    public function testCanCalculateWhenIsFalse()
    {
        $this->salesUpgradeStatusRepository
            ->getPending()
            ->shouldBeCalled()
            ->willReturn(null);

        $pending = $this->changeStatusSale->canCalculate();
        self::assertTrue($pending);
    }

    public function testCanCalculateWhenIsTrue()
    {
        $statusMock = $this->prophesize(SalesUpgradeStatus::class)->reveal();

        $this->salesUpgradeStatusRepository
            ->getPending()
            ->shouldBeCalled()
            ->willReturn($statusMock);

        $pending = $this->changeStatusSale->canCalculate();
        self::assertFalse($pending);
    }

    public function testCommandExecuteCheckWhenIsFalse()
    {
        $this->salesUpgradeStatusRepository
            ->getPending()
            ->shouldBeCalled()
            ->willReturn(null);

        $pending = $this->changeStatusSale->commandExecuteCheck();
        self::assertFalse($pending);
    }

    public function testCommandExecuteCheckWhenIsValidated()
    {
        $statusMock = $this->prophesize(SalesUpgradeStatus::class)->reveal();

        $this->salesUpgradeStatusRepository
            ->getPending()
            ->shouldBeCalled()
            ->willReturn($statusMock);

        $statusMock->getValidated()->shouldBeCalled()->willReturn(true);
        $this->entityManager->persist($statusMock)->shouldBeCalled();
        $this->entityManager->flush()->shouldBeCalled();

        $this->changeStatusSale->commandExecuteCheck();
    }



    





}
