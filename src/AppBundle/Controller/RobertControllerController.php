<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RobertControllerController extends Controller
{
    /**
     * @Route("/robert", name="robert")
     */
    public function robertAction()
    {
        return $this->render('robert/index.html.twig');
    }
}
