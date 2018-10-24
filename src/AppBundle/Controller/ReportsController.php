<?php

namespace AppBundle\Controller;

use Proxies\__CG__\AppBundle\Entity\Oferta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/reports")
 * */
class ReportsController extends Controller
{
    /**
     * @Route("/list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository(Oferta::class);

        $ofertas = $em->findAll();

        foreach ($ofertas as $of){
            echo $of->getNombre();
        }

        die();

        return $this->render('AppBundle:Reports:list.html.twig', array(
            // ...
        ));
    }

}
