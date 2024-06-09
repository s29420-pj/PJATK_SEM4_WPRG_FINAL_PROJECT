<?php

class PostController
{
    private $db;
    private $postModel;
    private $commentModel;
    private $logModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->postModel = new Post($db);
        $this->commentModel = new Comment($db);
        $this->logModel = new Log($db);
    }

    public function addPost($title, $content)
    {
        $this->postModel->addPost($title, $content);
        $this->logModel->addLog($this->userModel->getId(), 'Added new post.');

        header('Location: /posts.php');
    }

    public function editPost($postId, $title, $content)
    {
        $this->postModel->editPost($postId, $title, $content);
        $this->logModel->addLog($this->userModel->getId(), 'Edited post.');

        header('Location: /post.php?id=' . $postId);
    }

    public function deletePost($postId)
    {
        $this->postModel->deletePost($postId);
        $this->logModel->addLog($this->userModel->getId(), 'Deleted post.');

        header('Location: /posts.php');
    }

    public function viewPost($postId)
    {
        $post = $this->postModel->getPostById($postId);
        $comments = $this->commentModel->getCommentsByPostId($postId);
        include_once 'views/post.php';
    }

    public function nextPost($postId)
    {
        $post = $this->postModel->getNextPost($postId);
        $comments = $this->commentModel->getCommentsByPostId($post['id']);
        include_once 'views/post.php';
    }

    public function previousPost($postId)
    {
        $post = $this->postModel->getPreviousPost($postId);
        $comments = $this->commentModel->getCommentsByPostId($post['id']);
        include_once 'views/post.php';
    }

    public function groupPostsByDate()
    {
        $posts = $this->postModel->getAllPosts();
        $groupedPosts = [];

        foreach ($posts as $post) {
            $date = date('Y-m-d', strtotime($post['created_at']));
            $groupedPosts[$date][] = $post;
        }

        include_once 'views/post_list.php';
    }
}