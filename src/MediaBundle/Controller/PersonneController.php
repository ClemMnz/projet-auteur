<?php

namespace MediaBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use MediaBundle\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PersonneController extends Controller
{
    public function editAction(Request $request, Personne $personne = null)
    {
        $message = '';
        $em = $this->getDoctrine()->getManager();

        try {
            if ($personne == null) {
                $personne = new Personne();
            }

            // createFormBuilder utilisé avec un objet $p
            // crée un objet formulaire dédié à un objet Personne
            $form = $this->createFormBuilder($personne)
                ->add('nom')
                ->add('prenom')
                ->add('dateNaissance')
                ->add('email', TextType::class, ['label' => 'Votre email'])
                ->add('password', PasswordType::class)
                ->add('Enregistrer', SubmitType::class)
                ->getForm();

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($personne);
                $em->flush();
                return $this->redirectToRoute('media_listPersonne');
            }
        } catch (UniqueConstraintViolationException $ex) {
            $message = "L'utilisateur existe déjà.";
        }
        // On ne peut pas passer à une vue un objet formulaire directement
        // il faut impérativement appeler la méthode createView()
        return $this->render('MediaBundle:Default:form.html.twig',
            ['formulaire' => $form->createView(),
                'message' => $message
            ]
        );

    }


    public function indexAction()
    {
        // Création d'une personne
        $p = new Personne();
        $p->setNom('test insertion');
        $p->setEmail('test@test' . date('His') . '.fr');
        $p->setPrenom('prénom');
        $p->setPassword('Pa$$w0rd');

        $msg = '';
        try {
            // Récupération du gestionnaire d'entité
            // entity manager doctrine pour insertion
            $em = $this->getDoctrine()->getManager();

            // Demande de sauvegarde de l'objet
            $em->persist($p);
            // Execution réelle de la requete
            $em->flush();

            $msg = 'Insertion OK';
        } catch (\Exception $ex) {
            $msg = $ex->getMessage();
        }

        return $this->render('MediaBundle:Personne:index.html.twig',
            ['msg' => $msg]);
    }

    /**
     * Affichage de la liste des personnes
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $message = '';
        // Récupération du gestionnaire d'entité
        $em = $this->getDoctrine()->getManager();

        // Branchement au repository de personnes :
        // (Gestionnaire d'entités Personne)
        $repository = $em->getRepository('MediaBundle:Personne');


        $personnes = $repository->findAll();

        // Récupération d'un message en cas de suppression, mise à jour ...

        /* @var $bag FlashBag */
        $bag = $this->container->get('session')->getFlashBag();
        // dump($bag->get('message'));
        $messages = $bag->get('message');
        if (!empty($messages[0]))
            $message = $messages[0];

        // Envoie de la liste à la vue : la liste sera exploitable
        // dans twig avec le nom personnesList
        return $this->render('MediaBundle:Personne:liste.html.twig',
            ['personnesList' => $personnes,
                'message' => $message]);
    }

    /**
     * Suppression d'un objet Personne
     * @param $id
     */
    public function deleteAction($id)
    {

        try {
            // Récupération du gestionnaire d'entité
            $em = $this->getDoctrine()->getManager();

            $repository = $em->getRepository("MediaBundle:Personne");
            $p = $repository->find($id);

            $em->remove($p);
            $em->flush();

            $this->addFlash('message', 'Suppression OK.');

        } catch (\Exception $ex) {
            $this->addFlash('message', 'Erreur lors de suppression.' . $ex->getMessage());
        }

        // On redirige vers la liste de personnes
        return $this->redirectToRoute('media_listPersonne');

    }

}