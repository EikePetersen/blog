<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Page;
use AppBundle\Entity\Entry;
use AppBundle\Entity\User;
use AppBundle\Form\EntryType;
use AppBundle\Form\EditEntryType;
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
    public function getUsers() {

        $repository = $this->getDoctrine()
            ->getRepository(User::class);
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

        $form = $this->createForm(EditEntryType::class, $entry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $entry = new Entry();

            $entry->setId($form->getData()->getId());
            $entry->setTitle($form->getData()->getTitle());
            $entry->setAuthor($form->getData()->getAuthor());
            $entry->setContent($form->getData()->getContent());

            $preview = $entry->getContent();
            $preview = strip_tags($preview);
            if(strlen($preview) > 125) $preview = str_split($preview, 121)[0] . " ...";
            else $preview = $preview;

            $entry->setPreview($preview);
            $entry->setDate($form->getData()->getDate());

            // ... perform some action, such as saving the task to the database
            $em = $this->getDoctrine()->getManager();
            $em->merge($entry);
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
     * @Route("/admin/entry/new", name="new")
     */
    public function newEntry(Request $request) {

        $entry = new Entry();

        $form = $this->createForm(EntryType::class, $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entry = $form->getData();

            $preview = $entry->getContent();
            $preview = strip_tags($preview);
            if(strlen($preview) > 125) $preview = str_split($preview, 121)[0] . " ...";
            else $preview = $preview;

            $entry->setPreview($preview);

            $day = date("d.m.Y");
            $time = date("H:i");

            $date = $day . " um " . $time . " Uhr";
            $entry->setDate($date);

            // ... perform some action, such as saving the task to the database
            $em = $this->getDoctrine()->getManager();
            $em->persist($entry);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('default/new.html.twig', array(
            "content"=>array(
                "headline"=>"Beitrag bearbeiten",
                "text"=>"",
                "form"=>$form->createView(),
            ),
        ));
    }
    /**
     * @Route("/admin/entry/delete/{id}", name="delete")
     */
    public function deleteEntry($id) {
        $entry = $this->getEntry($id);
        $repository = $this->getDoctrine()->getManager();
        $repository->remove($entry);
        $repository->flush();

        return new Response("Deleted successfully. <a href='/admin/entry'>Back</a>");
    }
    /**
     * @Route("/admin/pages/edit/{title}", name="editPages")
     */
    public function editPages(Request $request, $title) {

        $id = 0;


        switch($title) {
            case "about":
                $id = 1;
                break;
            case "impressum":
                $id = 2;
                break;
        }

        // ... perform some action, such as saving the task to the database
        $em = $this->getDoctrine()->getManager();
        $page = $em->find(
            Page::class,
            $id
        );

        $form = $this->createFormBuilder($page)
            ->add('name', TextType::class, array('label' => "Titel: ", "required" => true))
            ->add('content', TextareaType::class, array('label' => "Inhalt: ", "required" => true))
            ->add('save', SubmitType::class, array('label' => 'Bearbeiten'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $page = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->merge($page);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('default/editStatic.html.twig', array(
            "form"=>$form->createView(),
        ));
    }
    /**
     * @Route("/admin/user", name="user")
     */
    public function user() {
        return $this->render('default/user.html.twig', array(
            "users"=>$this->getUsers(),
        ));
    }
    /**
     * @Route("/admin/toggle/{user}", name="toggleUser")
     */
    public function toggleAdmin($user) {
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $User = $repository->findOneBy(["username"=>$user]);

        $User->setSuperAdmin(!$User->isSuperAdmin());

        $em = $this->getDoctrine()->getManager();
        $em->merge($User);
        $em->flush();

        return new Response("<a href='/admin/user'>Zur&uuml;ck</a>");
    }

}