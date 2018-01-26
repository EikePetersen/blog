<?php

namespace AppBundle\Controller;

use AppBundle\Classes\BlogAsset;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller {

    /**
     * @Route("")
     */
    public function indexAction() {
        // The array that holds the type and the url of the asset
        $assets = array();

        // Fill the asset array
        $asset[] = new BlogAsset("css", "main.css");


        return $this->render('default/index.html.twig', array(
            "assets" => $assets
        ));
    }
}
