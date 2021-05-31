<?php

namespace App\Repositories\Interfaces;

/**
 * @author Vahid Mohammadi
 * Interface PostRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface PostRepositoryInterface{

    /**
     * list of all posts
     * @return mixed
     */
    public function postsList();

    /**
     * create new post
     * @param array $post
     * @return mixed
     */
    public function postCreate(array $post);

    /**
     * update post by post_id
     * @param array $post
     * @param $post_id
     * @return mixed
     */
    public function postUpdate(array $post, $post_id);

    /**
     * delete post by post_id
     * @param $post_id
     * @return mixed
     */
    public function postDelete($post_id);

    /**
     * post details
     * @param $post_id
     * @return mixed
     */
    public function postDetails($post_id);
}
