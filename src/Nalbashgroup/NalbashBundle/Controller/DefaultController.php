<?php

namespace Nalbashgroup\NalbashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="my_index")
     */
    public function indexAction()
    {
        //$this->get('nalbashgroup_nalbash.example');
        return $this->render('NalbashgroupNalbashBundle:Default:index.html.twig');
    }

    /**
     * @Route("/about", name="my_about")
     */
    public function aboutAction()
    {
        //$this->get('nalbashgroup_nalbash.example');
        return $this->render('NalbashgroupNalbashBundle:Default:about.html.twig');
    }
}
