<?php
/**
 * Created by PhpStorm.
 * User: praktikant-dev
 * Date: 29.01.2018
 * Time: 10:29
 */

namespace AppBundle\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    /**
     * Matches /page/*
     *
     * @Route("/page/{type}", name="page")
     */
    public function pageAction($type)
    {
        switch ($type) {
            case "about":
                $id = 1;
                break;
            case "impressum":
                $id = 2;
                break;
            default:
                break;
        }

        $page = $this->getDoctrine()
            ->getRepository(Page::class)
            ->find($id);
        if (!$page) {
            $header = "Error 404";
            $content = "Die von ihnen gesuchte Seite existiert nicht";

        } else {
            $header = $page->getName();
            $content = $page->getContent();
        }

        return $this->render('default/page.html.twig', array("header" => $header, "content" => $content));
    }
}