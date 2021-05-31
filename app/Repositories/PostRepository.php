<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

/**
 * @author Vahid Mohammadi
 * Class PostRepository
 * @package App\Repositories
 */
class PostRepository implements PostRepositoryInterface{


    /**
     * list of all posts
     * @return mixed
     */
    public function postsList()
    {
        try{
            return Post::all();
        }
        catch (QueryException $exception){
            return '101';
        }
    }

    /**
     * create new post
     * @param array $post
     * @return mixed
     */
    public function postCreate(array $post)
    {
        try{
            $new_post = Post::create($post);
            return $new_post->id;
        }
        catch (QueryException $exception){
            return '101';
        }
    }

    /**
     * update post by post_id
     * @param array $post
     * @param $post_id
     * @return mixed
     */
    public function postUpdate(array $post, $post_id)
    {
        try{
            $the_post = Post::Post($post_id);
            $the_post->update($post);
        }
        catch (QueryException $exception){
            return '101';
        }
        catch (ModelNotFoundException $ex){
            return '102';
        }
    }

    /**
     * delete post by post_id
     * @param $post_id
     * @return mixed
     */
    public function postDelete($post_id)
    {
        try{
            $the_post = Post::Post($post_id);
            $the_post->delete();
        }
        catch (QueryException $exception){
            return '101';
        }
        catch (ModelNotFoundException $ex){
            return '102';
        }
    }

    /**
     * post details
     * @param $post_id
     * @return mixed|void
     */
    public function postDetails($post_id)
    {
        return Post::post($post_id);
    }
}
