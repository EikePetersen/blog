<?php

namespace AppBundle\Controller;

use AppBundle\Classes\BlogAsset;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class EntryController extends Controller {

    /**
     * @Route("/blogentry")
     */
    public function indexAction() {
        // The array that holds the type and the url of the asset
        $assets = array();

        // Fill the asset array
        $assets[] = new BlogAsset("css", "style.css");

        return $this->render('default/blogentry.html.twig', array(
            "assets" => $assets,
        ));
    }
}
