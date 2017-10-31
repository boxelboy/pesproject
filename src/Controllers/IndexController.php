<?php
namespace App\Controllers;

use Respect\Validation\Validator as v;

class IndexController extends BaseController
{

    public function index($request, $response)
    {
        return $this->view->render($response, 'index.twig');
    }

    public function login($request, $response)
    {
        $validation = $this->validator->validate($request ,[
            'email' => v::noWhitespace()->notEmpty()->email(),
            'password' => v::noWhitespace()->notEmpty()
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('login'));
        } else {
            if (UserController::doLogin($request->getParam('email'), $request->getParam('password'))) {
                return $response->withRedirect($this->router->pathFor('welcome'));
            }

        }

    }

    public function logout($request, $response)
    {
        unset($_SESSION['user']);
        unset($_SESSION['name']);
        return $response->withRedirect($this->router->pathFor('login'));
    }

}