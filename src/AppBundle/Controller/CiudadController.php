<?php
/**
 * Created by PhpStorm.
 * User: JLEON
 * Date: 9/27/2018
 * Time: 4:42 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CiudadController extends Controller
{
    public function listaCiudadesAction($ciudad){
        $em = $this->getDoctrine()->getManager();
        $ciudades = $em->getRepository('AppBundle:Ciudad')->findAll();

        return $this->render('ciudad/_lista_ciudades.html.twig', array(
            'ciudades' => $ciudades,
            'ciudadActual' => $ciudad
        ));
    }
}