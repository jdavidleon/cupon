<?php
/**
 * Created by PhpStorm.
 * User: JLEON
 * Date: 10/3/2018
 * Time: 9:35 AM
 */

namespace AppBundle\Upload\Config;


use AppBundle\Entity\Enduser;
use Doctrine\Common\Collections\Collection;
use Manuel\Bundle\UploadDataBundle\Builder\ValidationBuilder;
use Manuel\Bundle\UploadDataBundle\Config\UploadConfig;
use Manuel\Bundle\UploadDataBundle\Entity\Upload;
use Manuel\Bundle\UploadDataBundle\Mapper\ColumnsMapper;

class DealsUploadConfig extends UploadConfig
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
            ->add('city_id', array(
                'label' => 'City',
                'required' => false,
                'aliases' => array('City', 'City ID'),
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
                'aliases' => array('Tax ID', 'taxid', 'idtax', 'Tax Id'),
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
//            ->with('active')
//            ->assertInternalType('boole')
//            ->end();
    }

    public function transfer(Upload $upload, Collection $items)
    {
        // TODO: Implement transfer() method.

        foreach ($upload->getValidItems() as $item) {
            $deal = new Enduser();
            $deal->setCountryId($item['country_id']);
            $deal->setProgram($item['program']);
            $deal->setName($item['name']);
            $deal->setTaxId($item['tax_id']);
            $deal->setActive($item['active']);
            $this->objectManager->persist($deal);
        }

        $this->objectManager->flush();

    }
}