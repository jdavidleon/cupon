<?php
/**
 * Created by PhpStorm.
 * User: jlp25
 * Date: 5/11/2018
 * Time: 5:29 PM
 */

namespace SalesBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use SalesBundle\Entity\SalesUpgradeStatus;
use SalesBundle\Repository\SalesUpgradeStatusRepository;

class ChangeUploadSale
{
    private $entityManager;

    private $salesUpgradeStatusRepository;
    
    public function __construct(
        EntityManagerInterface $em,
        SalesUpgradeStatusRepository $salesUpgradeStatusRepository
    )
    {
        $this->entityManager = $em;
        $this->salesUpgradeStatusRepository = $salesUpgradeStatusRepository;
    }


    public function canCalculate()
    {
        $pending = $this->salesUpgradeStatusRepository->getPending();

        return $pending === null ? true : false;
    }

    public function uploadFileCheck()
    {

    }

    public function commandExecuteCheck()
    {
        $pending = $this->salesUpgradeStatusRepository->getPending();

        if( null === $pending ){
            return false;
        }elseif ( $pending->getValidated() === true ){

        }

    }
    
}