<?php
/**
 * Created by PhpStorm.
 * User: JLEON
 * Date: 10/2/2018
 * Time: 10:27 AM
 */

namespace AppBundle\Service;


use Doctrine\Common\Collections\Collection;
use Manuel\Bundle\UploadDataBundle\Builder\ValidationBuilder;
use Manuel\Bundle\UploadDataBundle\Config\UploadConfig;
use Manuel\Bundle\UploadDataBundle\Entity\Upload;
use Manuel\Bundle\UploadDataBundle\Mapper\ColumnsMapper;

class UploadFiles extends UploadConfig
{

    public function configureColumns(ColumnsMapper $mapper)
    {
        $mapper
            ->add('country_id', array(
                'label' => 'Country ID',
                'required' => true,
                'aliases' => array('Country', 'Countries'),
                'similar' => true
            ))
            ->add('program', array(
                'label' => 'Program',
                'required' => true,
                'aliases' => array('Programs'),
                'similar' => true
            ))
            ->add('name', array(
                'label' => 'Name',
                'required' => true,
                'aliases' => array('Fames', 'First Name'),
                'similar' => true
            ))
            ->add('tax_id', array(
                'label' => 'Tax ID',
                'required' => true,
                'aliases' => array('Tax ID', 'taxid', 'idtax'),
                'similar' => true
            ))
            ->add('active', array(
                'label' => 'Active',
                'required' => true,
                'similar' => true
            ));
    }

    public function configureValidations(ValidationBuilder $builder)
    {
        // TODO: Implement configureValidations() method.
        $builder
            ->with('country_id')
                ->assertNotBlank()
            ->end()
            ->with('program')
            ->assertNotBlank()
            ->end()
            ->with('name')
            ->assertNotBlank()
            ->end()
            ->with('tax_id')
            ->assertNotBlank()
            ->end();
    }

    public function transfer(Upload $upload, Collection $items)
    {
        // TODO: Implement transfer() method.

    }
}