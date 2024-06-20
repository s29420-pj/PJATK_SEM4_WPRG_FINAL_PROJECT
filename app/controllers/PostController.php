<?php

namespace controllers;

use models\Post;

class PostController
{
    private $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function createPost($title, $content, $image = NULL, $userId)
    {
        $this->post->createPost($title, $content, $image, $userId, date('Y-m-d H:i:s'));
    }

    public function editPost($id, $title, $content, $image = NULL, $userId)
    {
        $this->post->editPost($id, $title, $content, $image, $userId);
    }

    public function removePost($postId, $authorId)
    {
        $this->post->removePost($postId, $authorId);
    }

    public function getPost($postId)
    {
        return $this->post->getPost($postId);
    }

    public function getAllPosts()
    {
        return $this->post->getAllPosts();
    }

    public function getPostAuthor($postId)
    {
        return $this->post->getPostAuthor($postId);
    }
}