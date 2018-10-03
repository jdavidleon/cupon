<?php
/**
 * Created by PhpStorm.
 * User: JLEON
 * Date: 10/2/2018
 * Time: 10:45 AM
 */

namespace AppBundle\Controller;


use Manuel\Bundle\UploadDataBundle\Entity\Upload;
use Manuel\Bundle\UploadDataBundle\Form\Type\UploadType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\GlobalController;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("enduser/")
 */
class EnduserController extends GlobalController
{
    /**
    * @Route("list", name="enduser_list")
    */
    public function listAction(Request $request)
    {
        $config = $this->getUploadConfig();
        $query = $config->getQueryList($this->get('upload_data.upload_repository'));
        $items = $this->paginate($query);

        return $this->render('enduser/list.html.twig', array(
            'items' => $items,
            'config' => $config,
        ));
    }

    /**
    * @Route("new", name="new_enduser")
     */
    public function newAction(Request $request)
    {
        $config = $this->getUploadConfig();
        $urlAction = $request->getRequestUri();

        $form = $this->createForm(UploadType::Class, null, array(
            'action' => $urlAction
        ));

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ){
            $file = $form['file']->getData(); /*Obtengo archivo*/

            try{

                $upload = $config->processUpload($file, $form->getData());

                return $this->redirectToRoute('deals_upload_select_columns',array(
                    'id' => $upload->getId()
                ));

            } catch (\Exception $e){
                $this->addFlash('error', 'Ha ocurrido un error');
            }
        }

        return $this->render('enduser/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
    * @Route("match/{id}", name="deals_upload_select_columns")
     */
    public function selectColumnsAction(Request $request, Upload $upload)
    {
        $matcher = $this->get('upload_data.headers_matcher.excel');
        $config = $this->getUploadConfig();

        /*
         * Obtiene la info por default del match
         * */
        $matchingInfo = $matcher->getDefaultMatchInfo(
            $config, $upload, array('row_headers' => 1)
        );

        if ($request->isMethod('POST') and $request->request->has('columns')) {

            /*  */
            $matcher->applyMatch($config, $matchingInfo, $request->request->get('columns'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($upload);
            $em->flush();

            $config->processRead($upload);

            return $this->redirectToRoute('enduser_list');
        }

        return $this->render('enduser/upload/match.html.twig', array(
            'upload' => $upload,
            'match_info' => $matchingInfo,
        ));
    }

    public function validateAction(Upload $upload)
    {
        try{

            $this->getUploadConfig()->processValidation($upload, true);

            $this->addFlash('success', 'Validado');

        }catch (\Exception $e){
            throw $e;

            $this->addUploadExceptionLog($e);

            $this->addFlash('error', 'Ha ocurido un problema, No se pudo ompletar la tarea' );

        }

        return $this->redirectToRoute()
    }

    public function getUploadConfig()
    {
        return $this->get('upload_data.config_provider')->get('deals');
    }
}