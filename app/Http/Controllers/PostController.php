<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Traits\CommonFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @author Vahid Mohammadi
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    use CommonFunction;

    /**
     * @var PostRepositoryInterface
     */
    private $post;

    /**
     * PostController constructor.
     * @param PostRepositoryInterface $post
     */
    public function __construct(PostRepositoryInterface $post)
    {
        $this->post = $post;
    }

    /**
     * display all posts in database
     * @return \Illuminate\Http\JsonResponse
     */
    public function allPosts(){

        $user = Auth::user();
        if ($user->can('viewAny',Post::class)){
            $posts = $this->post->postsList();
            if ($posts == '101')
                return response()->json(['result'=>'خطا در انجام عملیات'],500);
            return response()->json(['result'=>$posts],200);
        }
        else
            return response()->json(['result'=>'اجازه دسترسی وجود ندارد.'],403);

    }

    /**
     * create new post
     * @param title,body
     * @return post_id
     */
    public function newPost(PostRequest $request){

        //assign author of post
        $user = Auth::user();
        if ($user->can('create',Post::class)){
            $input = $request->all();
            $input['user_id'] = $user->id;
            //create post by repository design pattern
            $new_post = $this->post->postCreate($input);
            //check result
            if ($new_post == '101')
                return response()->json(['result'=>'خطا در انجام عملیات'],500);
            return response()->json(['result'=>$new_post],201);
        }
        else
            return response()->json(['result'=>'اجازه دسترسی وجود ندارد.'],403);
    }

    /**
     * edit post by post_id
     * @param UpdatePostRequest $request
     * @param $id
     * @return post_id
     */
    public function editPost(UpdatePostRequest $request, $id){

        if ($this->IsIdValid($id))
            return response()->json(['result'=>'Bad request.'],400);

        $user = Auth::user();
        $the_post = $this->post->postDetails($id);
        if ($user->can('update', $the_post)) {
            $post = $this->post->postUpdate($request->all(),$id);
            if ($post == '101')
                return response()->json(['result'=>'خطا در انجام عملیات'],500);
            if ($post == '102')
                return response()->json(['result'=>'اطلاعات مورد نظر یافت نشد.'],404);

            return response()->json(['result'=>'عملیات با موفقیت انجام شد.'],200);
        }
        else
            return response()->json(['result'=>'اجازه دسترسی وجود ندارد.'],403);

    }

    /**
     * soft delete post by post_id
     * @param UpdatePostRequest $request
     * @param $id
     * @return 204 status code
     */
    public function deletePost($id){

        if ($this->IsIdValid($id))
            return response()->json(['result'=>'Bad request.'],400);
        $user = Auth::user();
        $the_post = $this->post->postDetails($id);
        if ($user->can('delete', $the_post)) {

            $post = $this->post->postDelete($id);

            if ($post == '101')
                return response()->json(['result'=>'خطا در انجام عملیات'],500);
            if ($post == '102')
                return response()->json(['result'=>'اطلاعات مورد نظر یافت نشد.'],404);

            return response()->json([],204);
        }
        else
            return response()->json(['result'=>'اجازه دسترسی وجود ندارد.'],403);
    }
}
