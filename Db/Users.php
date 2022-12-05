<?php

namespace Db;

class Users extends DB
{

    protected const TABLE = 'users';

    protected function validate(array $usersData): bool
    {
        if (!filter_var($usersData['email'], FILTER_VALIDATE_EMAIL) || empty($usersData['email'])) {
            return false;
        } else {
            return true;
        }

    }
    protected function hash(array $usersData): string
    {
        return md5($usersData['pass']);
    }
}
