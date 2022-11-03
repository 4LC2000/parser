<?php

class Config
{
    static function get($section)
    {
        $initial_config = parse_ini_file('config.ini', true);

        return (object) $initial_config[$section];
    }
}