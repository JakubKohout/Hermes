<?php

namespace Hermes\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HermesAdminBundle:Default:index.html.twig');
    }
}
