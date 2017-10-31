<?php
namespace App\Controllers;

use App\Models\Organisation;
use App\Models\User;
use Respect\Validation\Validator as v;

class OrganisationController extends BaseController
{
    public static function getOrganisations()
    {
        $organisation = Organisation::all()->sortBy('name');
        $orgList = [];
        foreach ($organisation as $org){
            $orgList[] = array(
                'id' => $org->id,
                'name' => $org->name,
                'telephone' => $org->phone);
        }

        return $orgList;
    }

    public function getAll($request, $response)
    {
        $orgList = self::getOrganisations();

        $this->container->view->getEnvironment()->addGlobal('orgList', self::getOrganisations());
        return $this->view->render($response, 'organisations.twig');
    }


    public function getOrganisation($request, $response)
    {
        if ($request->getAttribute('id')) {
            $org = $request->getAttribute('id');
        } else {
            $user = User::find($_SESSION['user']);
            $org = $user->organisation;
        }

        $organisation  = Organisation::where('id', $org)->first();

        $orgList = [];
        foreach ($organisation->toArray() as $key => $value) {
            $orgList[$key] = $value;
        }

        $this->container->view->getEnvironment()->addGlobal('orgList', $orgList);
        return $this->view->render($response, 'organisation.twig');
    }

    public function add($request, $response)
    {
        return $this->view->render($response, 'newOrganisation.twig');
    }

    public function insert($request, $response)
    {
        $validation = $this->validator->validate($request ,[
            'name' => v::notEmpty(),
            'address' => v::notEmpty(),
            'town' => v::notEmpty(),
            'postcode' => v::notEmpty(),
            'country' => v::notEmpty(),
            'phone' => v::phone()
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('organisation.add'));
        } else {
            if ($this->save(
                $request->getParam('name'),
                $request->getParam('address'),
                $request->getParam('town'),
                $request->getParam('postcode'),
                $request->getParam('country'),
                $request->getParam('phone')
            )) {
                return $response->withRedirect($this->router->pathFor('organisations'));
            }
        }
    }

    public function save($name, $address, $town, $postcode, $country, $phone)
    {
        return Organisation::create(array(
            'name' => $name,
            'address' => $address,
            'town' => $town,
            'postcode' => $postcode,
            'country' => $country,
            'phone' => $phone
        ));
    }

    public function amend($request, $response)
    {
        $validation = $this->validator->validate($request ,[
            'address' => v::notEmpty(),
            'town' => v::notEmpty(),
            'postcode' => v::notEmpty(),
            'country' => v::notEmpty(),
            'phone' => v::notEmpty()->phone()
            ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('organisation'));
        } else {
            if ($this->update($request->getParam('id'),
                              $request->getParam('address'),
                              $request->getParam('town'),
                              $request->getParam('postcode'),
                              $request->getParam('country'),
                              $request->getParam('phone')
                )) {
                return $response->withRedirect($this->router->pathFor('organisation'));
            }
        }

    }

    public function update($id, $address, $town, $postcode, $country, $phone)
    {
        $org = Organisation::find($id);
        $org->address = $address;
        $org->town = $town;
        $org->postcode = $postcode;
        $org->country = $country;
        $org->phone = $phone;
        return $org->save();
    }

    public function delete($request, $response)
    {
        $id = $request->getAttribute('id');
        Organisation::destroy($id);
        $deleted = User::where('organisation', $id)->delete();

        return $response->withRedirect($this->router->pathFor('organisations'));
    }


}