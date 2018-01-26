<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller {

    

    public function indexAction() {
        return $this->render('a', array('a' => "a"));
    }

}
