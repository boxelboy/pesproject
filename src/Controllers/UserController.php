<?php
namespace App\Controllers;

use App\Models\Organisation;
use App\Models\User;
use Respect\Validation\Validator as v;

class UserController extends BaseController
{

    public static function doLogin($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }
         if ($user->password === $password) {
            $_SESSION['user'] = $user->id;
            $_SESSION['name'] = $user->firstname;
            return true;
         }

         return false;
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function user()
    {
        return User::find($_SESSION['user']);
    }

    public function getUserRole()
    {
        return User::select('role')->where('id', $_SESSION['user'])->get();
    }

    public function getAll($request, $response)
    {
        $user = $this->user();

        switch($user->role) {
            case 1:
                $users = User::all();
                break;
            case 2:
                $users = User::where('organisation', $user->organisation)->get();
                break;
            case 3:
                $users = User::where('id', $user->id)->get();
                break;
        }
        $userList = [];
        foreach ($users as $user){
            $userList[] = array(
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'organisation' => $user->organisation,
                'empID' => $user->empID);
        }
        $this->container->view->getEnvironment()->addGlobal('userList', $userList);
        return $this->view->render($response, 'users.twig');
    }

    public function add($request, $response)
    {
        $this->container->view->getEnvironment()->addGlobal('organisations', OrganisationController::getOrganisations());
        $this->container->view->getEnvironment()->addGlobal('roles', RoleController::getRoles());
        return $this->view->render($response, 'newUser.twig');
    }

    public function insert($request, $response)
    {
        $validation = $this->validator->validate($request ,[
            'firstname' => v::notEmpty(),
            'lastname' => v::notEmpty(),
            'email' => v::notEmpty()->email()->emailCheck(),
            'password' => v::notEmpty(),
            'role' => v::notEmpty(),
            'organisation' => v::notEmpty(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('user.add'));
        } else {
            if ($this->save(
                $request->getParam('firstname'),
                $request->getParam('lastname'),
                $request->getParam('address'),
                $request->getParam('town'),
                $request->getParam('postcode'),
                $request->getParam('country'),
                $request->getParam('phone'),
                $request->getParam('email'),
                $request->getParam('empID'),
                $request->getParam('password'),
                $request->getParam('role'),
                $request->getParam('organisation'),
                $request->getParam('dob'),
                $request->getParam('probation')
            )) {
                return $response->withRedirect($this->router->pathFor('users'));
            }
        }
    }

    public function save($firstname, $lastname, $address, $town, $postcode, $country, $phone, $email, $empID, $password, $role, $organisation, $dob, $probation)
    {
        return User::create(array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'address' => $address,
            'town' => $town,
            'postcode' => $postcode,
            'country' => $country,
            'phone' => $phone,
            'email' => $email,
            'empID' => $empID,
            'password' => $password,
            'role' => $role,
            'organisation' => $organisation,
            'dob' => $dob,
            'probation' => $probation
        ));
    }

    public function updUser($request, $response)
    {
        /*$user = User::find($_SESSION['user']);
        $organisation  = Organisation::where('id', $user->organisation)->first();

        $orgList = [];
        foreach ($organisation->toArray() as $key => $value) {
            $orgList[$key] = $value;
        }

        $this->container->view->getEnvironment()->addGlobal('orgList', $orgList);
        return $this->view->render($response, 'organisation.twig');*/
    }

    public function delUser($request, $response)
    {
        $id = $request->getAttribute('id');
        User::destroy($id);
        return $response->withRedirect($this->router->pathFor('welcome.twig'));
    }

}