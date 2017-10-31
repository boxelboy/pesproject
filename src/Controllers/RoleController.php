<?php
namespace App\Controllers;

use App\Models\Role;

class RoleController extends BaseController
{

    public static function getRoles()
    {
        $roles = Role::all();

        $roleList = [];
        foreach ($roles as $role){
            $roleList[] = array(
            'id' => $role->id,
            'role' => $role->role);
        }

        return $roleList;
    }

}