<?php

namespace MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TypeMediaController extends Controller
{
    public function indexAction()
    {
        return $this->render('MediaBundle:TypeMedia:index.html.twig');
    }
    public function listAction()
    {
        return $this->render('MediaBundle:TypeMedia:index.html.twig');
    }
}
