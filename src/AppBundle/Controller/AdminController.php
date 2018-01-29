<?php
/**
 * Created by PhpStorm.
 * User: praktikant-dev
 * Date: 29.01.2018
 * Time: 12:03
 */

namespace AppBundle\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function viewAdmin() {
        return $this->render('default/admin.html.twig');
    }

}