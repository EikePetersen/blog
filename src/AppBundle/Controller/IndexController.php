<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlogAsset;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller {

    /**
     * @Route("")
     */
    public function indexAction() {
        return $this->render('default/index.html.twig', array());
    }
}