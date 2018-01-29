<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class EntryController extends Controller {

    /**
     * @Route("e")
     */
    public function viewEntries() {
        return $this->render('default/entry.html.twig', array("name"=>10));
    }

}