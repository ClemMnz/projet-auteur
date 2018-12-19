<?php

namespace MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
    public function indexAction()
    {
        return $this->render('MediaBundle:Media:index.html.twig');
    }
    public function listAction()
    {
        return $this->render('MediaBundle:Media:index.html.twig');
    }
}
