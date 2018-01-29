<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Entry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class EntryViewController extends Controller {
    private $error;

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

        if($entry) { $this->error = 0; return $entry; }
        else {$this->error = 1; return ""; }
    }


    /**
     * @Route("article/", name="article")
     */
    public function viewEntries() {

        return $this->render('default/viewEntry.html.twig', array(
            "error"=>0,
            "view"=>false,
            "entries"=>$this->getEntries(),
        ));
    }

    /**
     * @Route("{language}/{url}.html")
     * @param String $url
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewEntry($url) {
        $title = "";
        $url = explode("-", $url);

        $id = $url[count($url) - 1];

        for($i = 0; $i < count($url) - 1; $i++) {
            if(!($i == count($url)- 2))
                $title .= $url[$i] . " ";
            else $title .= $url[$i];
        }

        return $this->render('default/viewEntry.html.twig', array(
            "error"=>$this->error,
            "view"=>true,
            "entry"=>$this->getEntry($id, $title),
        ));
    }

}