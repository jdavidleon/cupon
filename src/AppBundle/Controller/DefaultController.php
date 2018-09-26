<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Oferta;
use Doctrine\ORM\Mapping as Embedded;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
class DefaultController extends Controller{

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

    /**
     * @Route("/{ciudad}", defaults={ "ciudad" = "%app.ciudad_por_defecto%" }, name="portada")
     * @Route("/")
     */
    public function portadaAction($ciudad){

        if ($ciudad === null){
            return $this->redirectToRoute('portada', array(
               'ciudad' => $this->getParameter('app.ciudad_por_defecto')
            ));
        }

        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('AppBundle:Oferta')->findOneBy(array(
            'ciudad' => $this->getParameter('app.ciudad_por_defecto'),
//            'fechaPublicacion' => new \DateTime('today')
        ));

        if (!$oferta){
            throw $this->createNotFoundException(
                'No se ha encontrado la oferta del dia en la ciudad seleccionada'
            );
        }

        return $this->render('portada.html.twig', array(
           'oferta' => $oferta
        ));

        //        $emOferta = $this->getDoctrine()->getRepository('AppBundle:Oferta');
//        $emCiudad = $this->getDoctrine()->getRepository('AppBundle:Ciudad');
//
//        $oferta = $emOferta->find(1);
//
//        $precio = $oferta->getPrecio();
//
//        $allOfertas = $emOferta-<findAll();
//
//        // Encontrar todas las ofertas revisadas
//        $ofertasRevisadas = $emOferta->findBy(
//            array(
//                'revisada' => true
//            )
//        );
//
//        // Encontrar la ciudad de Vitoria-Gasteiz
//        $ciudad = $emCiudad->findBy(array(
//            'ciudad' => $ciudad->getId(),
//            'permiteEmail' => true
//        ));
//
//        $losMasVeteranos = $em->getRepository('AppBundle:Usuario')->findBy(
//            array( 'permiteEmail' => true ), /*Criterio de Busqueda*/
//            array( 'nombre' => 'ASC', 'fechaNacimiento' => 'DESC' ), /*Order*/
//            10, /*# de resultados*/
//            0 /*Empieza en posicion 0*/
//        );
//
//        $oferta = new Oferta();
//        $oferta->setNombre('Nombre');
//        $oferta->setPrecio(10.99);
//        $oferta->setDescripcion('Descripcion');
//        $oferta->setCondiciones('Lorem Ipsum');
//        $oferta->setDescuento(5.5);
//
//        $entityManager = $this->getDoctrine()->getManager()M
//        $entityManager->persist($oferta);
//        $entityManager->flush();
    }

    /**
     * @Route("/service/first")
     */
    public function listAction(){
        $logger = $this->container->get('logger');
        $logger->info('Look! I just aused a service');
        $messageGenerator = $this->container->get('app.message_generator');
        $message = $messageGenerator->getHappyMessage();
        $this->addFlash('success', $message);

        return $this->render('service/primero.html.twig');

    }


}
