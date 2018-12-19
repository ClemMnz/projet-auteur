<?php

namespace MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $script = '<script> alert(\'Toto\')</script>';

        return $this->render('MediaBundle:Default:index.html.twig',
             ['script' => $script ] );
    }
}
