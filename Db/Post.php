<?php

namespace Db;

class Post extends DB
{
    protected const TABLE = 'posts';

    protected $columns = [
        'full_text',
        'title',
        'link',
        'pub_date',
        'description',
        'category',
        'source'
    ];

    public function validate(array $insertData): bool
    {
        $keys = array_keys($insertData);
        $diff = array_diff($this->columns, $keys);

        if (empty($diff)) {
            return true;
        };

        return false;
    }
}
