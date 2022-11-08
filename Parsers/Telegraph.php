<?php

namespace Parsers;

class Telegraph extends RSS{
    protected function parseItem(\SimpleXMLElement $item): void
    {
        $this->setItem([
            'title' => (string)$item->title,
            'link' => (string)$item->link,
            'description' => (string)$item->description,
            'category' => (string)$item->category,
            'pub_date' => date('Y-m-d H:i:s', strtotime($item->pubDate)),

        ]);
    }
}