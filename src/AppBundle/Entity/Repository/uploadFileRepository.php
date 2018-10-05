<?php
/**
 * Created by PhpStorm.
 * User: JLEON
 * Date: 10/2/2018
 * Time: 2:17 PM
 */

namespace AppBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;
use Manuel\Bundle\UploadDataBundle\Mapper\ColumnsMapper;

class uploadFileRepository extends EntityRepository
{
    public function configureColumns(ColumnsMapper $mapper)
    {

    }
}