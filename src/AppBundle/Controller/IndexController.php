<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller {
    public function indexAction($name)
    {
        return $this->render('index.html.twig', array('name' => $name));
    }
}
