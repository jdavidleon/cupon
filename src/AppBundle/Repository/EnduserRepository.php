<?php
/**
 * Created by PhpStorm.
 * User: JLEON
 * Date: 10/2/2018
 * Time: 10:53 AM
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\Routing\Annotation\Route;

class EnduserRepository extends EntityRepository
{
    public function paginate($dql, $page = 1, $limit = 3)
    {
        $paginator = new Paginator($dql);
        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1)) // Offset
            ->setMaxResults($limit); // Limit
        return $paginator;
    }
    public function getAllDeals($currentPage = 1, $limit = 3, $order, $idCategory=null)
    {
        $filterCategory = '';
        if ($idCategory) {
            $filterCategory = 'AND c.id = '.$idCategory;
        }
        // Create the query
        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->where('c.active = 1 '.$filterCategory)
            ->orderBy('p.'.$order)
            ->getQuery();
        $paginator = $this->paginate($query, $currentPage, $limit);
        return array('paginator' => $paginator, 'query' => $query);
    }
}