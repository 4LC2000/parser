<?php

namespace Controllers;

use Db\Post;
use Parsers\Telegraph;

class PostController
{
    protected $posts;

    public function __construct()
    {
        $this->posts = new Post($_ENV);
    }
    public function view()
    {
        $newsList = $this->posts->get();
        include 'views/newsList.php';
    }
    public function addNews()
    {
        $telegraphParser = new Telegraph($_ENV['TELEGRAF_RSS']);
        $news = $telegraphParser->parse()->getItems();

        foreach ($news as $post) {
            $this->posts->store($post);
        }
    }
    public function post()
    {
        $post = $this->posts->getRecordById((int)$_GET['postId']);
        include 'views/new.php';
    }
    public function update()
    {
        return $this->posts->update((int)$_GET['postId'], $_POST);
    }
}
