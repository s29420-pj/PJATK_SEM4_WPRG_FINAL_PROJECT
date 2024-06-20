<?php

namespace controllers;

use models\Post;
use Exception;

class PostController {
    private $post;

    public function __construct() {
        $this->post = new Post();
    }

    public function createPost($title, $content, $authorId) {
        $this->post->createPost($title, $content, $authorId);
    }

    public function editPost($postId, $title, $content, $authorId) {
        $this->post->editPost($postId, $title, $content, $authorId);
    }

    public function removePost($postId, $authorId) {
        $this->post->removePost($postId, $authorId);
    }

    public function getPost($postId) {
        return $this->post->getPost($postId);
    }

    public function getAllPosts() {
        return $this->post->getAllPosts();
    }
}