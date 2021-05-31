<?php


namespace App\Repositories;


use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class PermissionRepository implements PermissionRepositoryInterface
{

    /**
     * get permission for models policy
     * @param model,$user_id
     * @return permsission
     */
    public function getPermission($model, $user_id)
    {
        $permission = Permission::select('permission')->
            where('model_name', $model)->where('user_id', $user_id)->first();
        return $permission->permission;

    }


    /**
     * update permission
     * @param array $permission,$id
     * @return mixed
     */
    public function updatePermission(array $permission,$permission_id){

        try{
            $the_permission = Permission::Permission($permission_id);
            $the_permission->update($permission);
        }
        catch (QueryException $exception){
            return '101';
        }
        catch (ModelNotFoundException $ex){
            return '102';
        }

    }
}
