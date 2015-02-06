<?php

namespace OKLM\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OKLMCommonBundle:Default:index.html.twig', array('name' => $name));
    }
}
