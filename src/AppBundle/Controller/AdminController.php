<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Entry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class AdminController extends Controller {

    private $error;

    public function getEntries() {

        $repository = $this->getDoctrine()
            ->getRepository(Entry::class);
        $entries = $repository->findAll();

        return $entries;
    }

    public function getEntry($id) {

        $repository = $this->getDoctrine()
            ->getRepository(Entry::class);

        $entry = $repository->findOneBy([
            'id' => $id,
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
                "text"=>"Hier kannst du Beitäge verwalten, löschen und erstellen, User löschen und zum Admin ernennen / zum User degradieren und die statischen Seiten (Über uns & Impressum) bearbeiten.",
                "entries"=>null,
            ),
        ));
    }

    /**
     * @Route("/admin/entry/", name="entries")
     */
    public function showEntries() {
        return $this->render('default/admin.html.twig', array(
            "content"=>array(
                "headline"=>"Beiträge",
                "text"=>"Hier kannst du alle Beiträge bearbeiten.",
            ),
            "entries"=>$this->getEntries(),
        ));
    }

    /**
     * @Route("/admin/entry/edit/{id}", name="edit")
     */
    public function editEntry(Request $request, $id) {

        $entry = $this->getEntry($id);

        $form = $this->createFormBuilder($entry)
            ->add('title', TextType::class, array('label' => "Titel: ", "required" => true))
            ->add('content', TextareaType::class, array('label' => "Inhalt: ", "required" => true))
            ->add('save', SubmitType::class, array('label' => 'Bearbeiten'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $entry = new Entry();

            $entry->setId($form->getData()->getId());
            $entry->setTitle($form->getData()->getTitle());
            $entry->setAuthor($form->getData()->getAuthor());
            $entry->setContent($form->getData()->getContent());

            $preview = preg_replace('%<a href=.*?>(.*)?</a>%', "$1", $form->getData()->getContent());
            $preview = preg_replace('%<p>(.*)?</p>%', "$1", $preview);
            if(strlen($preview) > 125) $preview = str_replace($preview, 121) . " ...";
            else $preview = $preview;

            $entry->setPreview($preview);
            $entry->setDate($form->getData()->getDate());

            // ... perform some action, such as saving the task to the database
            $em = $this->getDoctrine()->getManager();
            $em->persist($entry);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('default/edit.html.twig', array(
            "content"=>array(
                "headline"=>"Beitrag bearbeiten",
                "text"=>"",
                'form' => $form->createView(),
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
                "entries"=>$this->getEntries(),
            ),
        ));
    }

    /**
     * @Route("/admin/entry/delete/{id}", name="delete")
     */
    public function deleteEntry($id) {
        return $this->render('default/delete.html.twig', array(
            "content"=>array(
                "headline"=>"Beitrag löschen",
                "text"=>"",
                "entries"=>null,
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
                "entries"=>null,
            ),
        ));
    }

}