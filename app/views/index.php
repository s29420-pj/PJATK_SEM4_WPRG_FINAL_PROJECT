<?php
require_once __DIR__ . '/app.php';

use models\Post;

$postModel = new Post();
$posts = $postModel->getAllPosts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4">Posts</h1>
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="<?php echo $post['image']; ?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $post['title']; ?></h4>
                        <p class="card-text"><?php echo $post['content']; ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Author: <?php echo $postModel->getPostAuthor($post['id']); ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>