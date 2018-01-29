<?php

namespace AppBundle\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller {

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
     * @Route("/admin", name="admin")
     */
    public function viewAdmin() {
        return $this->render('default/admin.html.twig', array(
            "content"=>array(
                "headline"=>"Admin-Berreich",
                "text"=>"Hier kannst du Beit�ge verwalten, l�schen und erstellen, User l�schen und zum Admin ernennen / zum User degradieren und die statischen Seiten (�ber uns & Impressum) bearbeiten.",
            ),
        ));
    }

    /**
     * @Route("/admin/entry/", name="edit")
     */
    public function showEntries() {
        return $this->render('default/admin.html.twig', array(
            "content"=>array(
                "headline"=>"Beitr�ge",
                "text"=>"Hier kannst du alle Beitr�ge bearb",
            ),
        ));
    }

    /**
     * @Route("/admin/entry/edit/{id}", name="edit")
     */
    public function editEntry($id) {
        return $this->render('default/admin.html.twig', array(
            "content"=>array(
                "headline"=>"Beitrag bearbeiten",
                "text"=>"",
            ),
        ));
    }

    /**
     * @Route("/admin/entry/new/{id}", name="new")
     */
    public function newEntry($id) {
        return $this->render('default/admin.html.twig', array(
            "content"=>array(
                "headline"=>"Beitrag bearbeiten",
                "text"=>"",
            ),
        ));
    }

    /**
     * @Route("/admin/entry/delete/{id}", name="delete")
     */
    public function deleteEntry($id) {
        return $this->render('default/admin.html.twig', array(
            "content"=>array(
                "headline"=>"Beitrag l�schen",
                "text"=>"",
            ),
        ));
    }

    /**
     * @Route("/admin/pages/edit/{title}", name="editPages")
     */
    public function editPages($title) {
        return $this->render('default/admin.html.twig', array(
            "content"=>array(
                "headline"=>"Statische Seiten bearbeiten",
                "text"=>"",
            ),
        ));
    }

}