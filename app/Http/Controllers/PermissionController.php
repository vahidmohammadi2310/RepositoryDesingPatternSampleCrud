<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Traits\CommonFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{

    use CommonFunction;
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
     * update user permission
     * @param permissions array with permission and modelName element
     * @param Request $request
     * @param $id user
     * @return \Illuminate\Http\JsonResponse
     */
    public function UpdateUserPermission(PermissionRequest $request, $id)
    {
        if ($this->IsIdValid($id))
            return response()->json(['result'=>'Bad request.'],400);

        $the_permission = $this->permission->updatePermission($request->all(),$id);
        if ($the_permission == '101')
            return response()->json(['result'=>'خطا در انجام عملیات'],500);
        if ($the_permission == '102')
            return response()->json(['result'=>'اطلاعات مورد نظر یافت نشد.'],404);

        return response()->json(['result'=>'عملیات با موفقیت انجام شد.'],200);
    }
}
