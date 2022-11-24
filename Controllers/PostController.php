<?php

namespace Controllers;

use Db\Post;
use Parsers\Telegraph;
use Parsers\Kg;
use Parsers\Kt;

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
        $this->store($news);


        $kgParser = new Kg($_ENV['KG_RSS']);
        $newsKg = $kgParser->parse()->getItems();
        $this->store($newsKg);

        $ktParser = new Kt($_ENV['KT_RSS']);
        $newsKt = $ktParser->parse()->getItems();
        $this->store($newsKt);
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

    private function store(array $news): void
    {
        foreach ($news as $post) {
            $this->posts->store($post);
        }
    }

    public function add()
    {
        dd($_POST);
        $this->store($_POST['news']);
    }
}
