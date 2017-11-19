<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Library\Controller\BaseController as Controller;
use Exception;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        try  {
            $phrase = $this->getApiBridgeService()->get('jokes/random');
        } catch (Exception $exception) {
            $phrase = [];
        }

        return $this->render('AppBundle:Homepage:homepage.html.twig', [
            'phrase' => $phrase,
        ]);
    }

    /**
     * @Route("/_get_phrase", name="ajax_homepage_get_phrase")
     */
    public function ajaxGetPhaseAction(Request $request)
    {
        $phrase = [];

        if($request->isXmlHttpRequest()) {
            try {
                $phrase = $this->getApiBridgeService()->get('jokes/random');
            } catch (Exception $exception) {
                $phrase = [];
            }
        }

        return new JsonResponse($phrase);
    }
}
