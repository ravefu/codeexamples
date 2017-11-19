<?php
/** Created by PhpStorm. */

namespace AppBundle\Library\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function getApiBridgeService()
    {
        return $this->get('examples.api.bridge');
    }
}
