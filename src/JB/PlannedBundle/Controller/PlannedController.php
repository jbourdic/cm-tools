<?php

namespace JB\PlannedBundle\Controller;

use JB\PlannedBundle\Entity\PlannedTweets;
use JB\PlannedBundle\Form\PlannedTweetsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlannedController extends Controller
{
    public function plannedIndexAction()
    {
        return $this->render('JBPlannedBundle:Planned:index.html.twig', array());
    }

    public function plannedListAction()
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("JBPlannedBundle:PlannedTweets");
        $plannedTweets = $repository->findByIdSender($userId);

        return $this->render('JBPlannedBundle:Planned:list.html.twig', array('plannedTweets' => $plannedTweets));
    }

    public function plannedViewAction($id)
    {
        // Ici, on récupérera l'annonce correspondante à l'id $id

        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'id' => $id
        ));
    }

    public function plannedAddAction(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        $plannedTweet = new PlannedTweets();

        $form = $this->createForm(new PlannedTweetsType, $plannedTweet);


        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($form->handleRequest($request)->isValid()) {
            $user = $this->getUser();
            $plannedTweet->setIdSender($user->getId());

            $em = $this->getDoctrine()->getManager();
            $em->persist($plannedTweet);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Tweet bien enregistrée.');

            // Puis on redirige vers la page de visualisation de cettte annonce
            //return $this->redirect($this->generateUrl('planned-tweet-list'));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('JBPlannedBundle:Planned:add.html.twig',array('form' => $form->createView()));
    }

    public function plannedEditAction($id, Request $request)
    {
        // Ici, on récupérera l'annonce correspondante à $id

        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirect($this->generateUrl('oc_platform_view', array('id' => 5)));
        }

        return $this->render('JBPlannedBundle:');
    }

    public function plannedDeleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }
}
