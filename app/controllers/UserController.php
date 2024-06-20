<?php

namespace controllers;

use models\User;
use Exception;

class UserController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function createUser($username, $password) {
        $this->user->createUser($username, $password);
    }

    public function authUser($username, $password) {
        return $this->user->authUser($username, $password);
    }

    public function resetPassword($id, $newPassword) {
        $this->user->resetPassword($id, $newPassword);
    }
}