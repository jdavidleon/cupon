<?php
/**
 * Created by PhpStorm.
 * User: JLEON
 * Date: 10/3/2018
 * Time: 3:23 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GlobalController extends Controller
{
    /**
     * Atajo para paginar una consulta de doctrine.
     *
     * @param Query|array $query
     * @param int $page
     * @param int $perPage
     * @param string $pageParameterName
     * @param array $options
     *
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function paginate($query, $page = null, $perPage = null, $pageParameterName = 'page', $options = [])
    {
        $request = $this->get('request_stack')->getCurrentRequest();

        $page = $page ?: $request->get('page', 1);
        $perPage = $perPage ?: $request->get('perPage', 10);

        return $this->get('knp_paginator')->paginate($query, $page, $perPage, array('pageParameterName' => $pageParameterName) + $options);
    }

}