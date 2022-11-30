<?php

namespace Db;

class Users extends DB
{

protected function validate(array $insertData): bool
{
    return true;
}

}