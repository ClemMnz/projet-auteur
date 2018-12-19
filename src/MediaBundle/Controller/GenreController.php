<?php

namespace MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GenreController extends Controller
{
    public function insertAction()
    {
        return $this->render('MediaBundle:Genre:index.html.twig');
    }
    public function listAction()
    {
        return $this->render('MediaBundle:Genre:index.html.twig');
    }
}
