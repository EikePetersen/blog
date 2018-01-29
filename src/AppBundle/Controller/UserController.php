<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller {

    /**
     * @Route("login", name="login")
     */
    public function login() {
    }

    /**
     * @Route("logout", name="logout")
     */
    public function logout() {
    }

}