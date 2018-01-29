<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Entry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class EntryViewController extends Controller {

    public function getEntries() {

        $repository = $this->getDoctrine()
            ->getRepository(Entry::class);
        $entries = $repository->findAll();

        return $entries;
    }

    public function getEntry($id, $title) {

        $repository = $this->getDoctrine()
            ->getRepository(Entry::class);

        $entry = $repository->findOneBy([
            'id' => $id,
            'title' => $title,
        ]);

        return $entry;
    }


    /**
     * @Route("article/", name="article")
     */
    public function viewEntries() {

        return $this->render('default/viewEntry.html.twig', array(
            "view"=>false,
            "entries"=>$this->getEntries(),
        ));
    }

    /**
     * @Route("{language}/{title}-{id}.html")
     * @param String $afterpart
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewEntry($id, $title) {
        return $this->render('default/viewEntry.html.twig', array(
            "view"=>true,
            "entry"=>$this->getEntry($id, $title),
        ));
    }

}