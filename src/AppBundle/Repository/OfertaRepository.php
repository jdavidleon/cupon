<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * OfertaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

class OfertaRepository extends EntityRepository
{
    /**
     * @param $ciudad
     * @return mixed
     */
    public function findOfertaDelDia($ciudad){

        $fechaPublicacion = new \DateTime('today');
        $fechaPublicacion->setTime(23, 59, 59);

        $em = $this->getEntityManager();
        $dql = 'SELECT o, c, t
            FROM AppBundle:Oferta o
            JOIN o.ciudad c JOIN o.tienda t
            WHERE o.revisada = true
            AND o.fechaPublicacion < :fecha
            AND c.slug = :ciudad
            ORDER BY o.fechaPublicacion DESC';

        $consulta = $em->createQuery($dql);
        $consulta->setParameter('fecha', $fechaPublicacion);
        $consulta->setParameter('ciudad', $ciudad);
        $consulta->setMaxResults(1);

        return $consulta->getSingleResult();
    }

    public function findOferta($ciudad, $slug){
        $em = $this->getEntityManager();

        $consulta = $em->createQuery('
            SELECT o, t, c 
            FORM AppBundle:Oferta o
            JOIN o.ciudad c JOIN o.tienda t
            WHERE o.revisada = true
            AND o.slug = :slug
            AND o,ciudad = :ciudad  
            ');
        $consulta->setParameter('slug', $slug);
        $consulta->setParameter('ciudad', $ciudad);
        $consulta->setMaxResults(1);

        return $consulta->getSingleResult();
    }

    public function findRelacionadas($ciudad){
        $em = $this->getEntityManager();

        $consulta = $em->createQuery('
            SELECT o, c
            FROM AppBundle:oferta o
            JOIN o.ciudad c
            WHERE o,revisada = true
                AND o.fechaPublicacion <= :fecha
                AND c.slug != :ciudad
            ORDER BY 0.fechaPublicacion DESC
            ');
        $consulta->setMaxResults(5);
        $consulta->setParameter('fecha', new \DateTime('today'));
        $consulta->setParameter('ciudad', $ciudad);

        return $consulta->getResult();
    }

}
