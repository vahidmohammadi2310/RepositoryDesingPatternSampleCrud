<?php

namespace App\Traits;

use App\Repositories\Interfaces\PermissionRepositoryInterface;

/**
 * @author Vahid Mohammadi
 * Trait CommonFunction
 * @package App\Traits
 */
trait CommonFunction
{

    /**
     * @var PermissionRepositoryInterface
     */
    private $permission;

    /**
     * CommonFunction constructor.
     * @param PermissionRepositoryInterface $permission
     */
    public function __construct(PermissionRepositoryInterface $permission)
    {
        $this->permission = $permission;
    }

    /**
     * check id is valid or not
     * @param $id
     * @return bool
     */
    public function IsIdValid($id){

        if (preg_match('/[!@#$%^&*(),.?":{}|<>]/', $id) || preg_match('/[a-zA-Z]/', $id)){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * get permission for models policy
     * @param model,$user_id
     * @return permsission
     */
    public function GetPermission($model, $user_id)
    {
        return $this->permission->getPermission($model,$user_id);

    }
}
