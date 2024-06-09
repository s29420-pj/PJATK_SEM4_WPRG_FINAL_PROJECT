S29420 - WPRG Final Project
======================
This is the final project for the WPRG at Polish-Japanese Academy of Information Technology. The project is a simple blog system with the following features:
- User registration and login
- User roles (admin, author, user)
  - admin (add posts, delete posts, edit posts, view logs)
  - author (add posts, delete posts, edit posts, reset password)
  - user (add comments, reset password)
- Admin panel
- Post management (add, delete, edit)
  - content (title, content, optional image)
  - auto-generate add date
  - group by date
  - next/previous post navigation
- comment system with date and author
  - if user is logged in, they can add a comment
  - if user is not logged in, they can add comments as a guest
- Contact form with blog author

The project is built using PHP, MySQL, and Bootstrap. The project is structured as follows:
```
WPRG_FINAL_PROJECT_s29420/
├── app/
│   ├── controllers/
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   └── PostController.php
│   ├── models/
│   │   ├── Comment.php
│   │   ├── Post.php
│   │   └── User.php
│   ├── views/
│   │   ├── admin/
│   │   │   ├── add_post.php
│   │   │   ├── edit_post.php
│   │   │   └── manage_posts.php
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── blog/
│   │   │   ├── post.php
│   │   │   └── post_list.php
│   │   └── base.php
│   ├── config.php
│   ├── db.php
│   └── init.php
├── migrations/
├── public/
│   ├── css/
│   ├── images/
│   └── js/
├── .gitignore
└── README.md
```

Posts, comments, and users are stored in the database.