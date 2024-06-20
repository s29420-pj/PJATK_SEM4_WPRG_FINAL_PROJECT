<?php

# Config file
require_once __DIR__ . '/config.php';

# Classes
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Post.php';
require_once __DIR__ . '/models/Comment.php';
require_once __DIR__ . '/models/Database.php';
require_once __DIR__ . '/models/Admin.php';

# Controllers
require_once __DIR__ . '/controllers/AdminController.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/PostController.php';
require_once __DIR__ . '/controllers/CommentController.php';