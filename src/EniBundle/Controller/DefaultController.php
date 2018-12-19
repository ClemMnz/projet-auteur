<?php

namespace EniBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EniBundle:Default:index.html.twig');
    }

    /**
     * @param $nom : parametre définit dans le path de la route
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function helloAction($nom)
    {
         dump($nom);
        // on envoie à la vue une variable nommée name
        // exploitée dans twig avec la syntaxe{{ name }}
        return $this->render('EniBundle:Hello:index.html.twig',
            ['name' => $nom]
            );
    }
}
