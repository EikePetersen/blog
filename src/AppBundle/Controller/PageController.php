<?php
/**
 * Created by PhpStorm.
 * User: praktikant-dev
 * Date: 29.01.2018
 * Time: 10:29
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Page;

class PageController extends Controller
{
    /**
     * Matches /page/*
     *
     * @Route("/page/{type}", name="page")
     */
    public function pageAction($type)
    {
        switch ($type)
        {
            case "about":
                $header="Über uns";
                $content="Die von ihnen aufgerufene Seite existiert nicht!";
                break;
            case "impressum":
                $header="Impressum";
                $content="Die von ihnen aufgerufene Seite existiert nicht!";
                break;
            default:
                $header="Error 404";
                $content="Die von ihnen aufgerufene Seite existiert nicht!";
                
        }
        return $this->render('default/page.html.twig', array("header"=>$header,"content"=>$content));
    }
}