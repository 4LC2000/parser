<?php

namespace Controllers;

use Db\Users;


class AuthController
{
    public $username;
    protected $users;
    protected $usersData;

    public function __construct()
    {
        $this->users = new Users($_ENV);
    }

    public function view()
    {
        include "./views/registration.php";
    }

    public function saveUserData()
    {
        $this->username = $_POST['username'];
        $this->pass = $_POST['password'];

        $this->usersData = [
            'email' => (string)$this->username,
            'pass' => (string)$this->pass
        ];
        $this->users->store($this->usersData);
    }

}
