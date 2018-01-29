<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Entry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller {

    public function getEntries() {

        $repository = $this->getDoctrine()
            ->getRepository(Entry::class);
        $entries = $repository->findAll();

        return $entries;
    }


    /**
     * @Route("")
     */
    public function indexAction() {

        return $this->render('default/index.html.twig', array(
            "entries"=>$this->getEntries(),
        ));
    }

}