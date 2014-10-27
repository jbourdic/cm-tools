<?php

namespace JB\PlannedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlannedController extends Controller
{
    public function indexAction()
    {
        return $this->render('JBPlannedBundle:Planned:index.html.twig', array());
    }
    public function plannedListAction()
    {
        return $this->render('JBPlannedBundle:Planned:list.html.twig', array());
    }
}
