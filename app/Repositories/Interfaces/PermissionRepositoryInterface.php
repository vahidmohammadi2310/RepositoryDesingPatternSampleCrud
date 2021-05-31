<?php

namespace App\Repositories\Interfaces;

interface PermissionRepositoryInterface{

    /**
     * get permission for models policy
     * @param model,$user_id
     * @return permsission
     */
    public function getPermission($model, $user_id);

    /**
     * update permission
     * @param array $array
     * @return mixed
     */
    public function updatePermission(array $array,$permission_id);
}
