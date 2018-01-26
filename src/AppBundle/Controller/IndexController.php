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

        $repository = $this->getDoctrine()->getRepository(BlogAsset::class);
        $assets = $repository->findAll();

        return $this->render('default/index.html.twig', array(
            "assets" => $assets,
        ));
    }
}