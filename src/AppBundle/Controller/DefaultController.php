<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route(
     *     "/sitio/{nombrePagina}/",
     *     name="pagina",
     *     defaults={  "nombrePagina" = "ayuda" },
     *     requirements={ "nombrePagina"="ayuda|privacidad|sobre_nosotros" }
     *   )
     */
    public function paginaAction($nombrePagina)
    {
        return $this->render('sitio/'.$nombrePagina.'.html.twig');
    }
}
