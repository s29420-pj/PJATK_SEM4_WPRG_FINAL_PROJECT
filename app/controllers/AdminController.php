<?php

namespace controllers;

use models\Admin;

class AdminController
{
    private $admin;

    public function __construct()
    {
        $this->admin = new Admin();
    }

    public function createUser($username, $password, $role, $adminId)
    {
        $this->admin->createUser($username, $password, $role);
    }

    public function removeUser($userId, $adminId)
    {
        $this->admin->removeUser($userId);
    }

    public function resetPassword($userId, $newPassword, $adminId)
    {
        $this->admin->resetPassword($userId, $newPassword);
    }

    public function editUserRole($userId, $role, $adminId)
    {
        $this->admin->editUserRole($role, $userId);
    }
}