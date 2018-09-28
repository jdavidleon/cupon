<?php
/**
 * Created by PhpStorm.
 * User: JLEON
 * Date: 9/28/2018
 * Time: 2:10 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class OfertaController extends Controller
{
    /**
     *  Retorna oferta concreta segun ciudad
     * @Route("/{ciudad}/oferta/{slug}", name="oferta")
     */
    public function ofertaAction($ciudad, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('AppBundle:Oferta')
                    ->findOferta($ciudad, $slug);
        $relacionadas = $em->getRepository( 'AppBundle:Oferta')
                ->findRelacionadas($ciudad);

        return $this->render('oferta/detalle.html.twig', array(
            'oferta' => $oferta,
            'relacionadas' => $relacionadas
        ));
    }


}