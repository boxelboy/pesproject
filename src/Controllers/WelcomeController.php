<?php
namespace App\Controllers;


class WelcomeController extends BaseController
{

    public function index($request, $response)
    {
        $this->container->view->getEnvironment()->addGlobal('name', $_SESSION['name']);
        return $this->view->render($response, 'welcome.twig');
    }

}