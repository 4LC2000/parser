<?php

namespace Parsers;

class Kt extends RSS
{
    protected function parseItem(\SimpleXMLElement $item): void
    {
        $this->setItem([
            'title' => (string)$item->title,
            'link' => (string)$item->link,
            'full_text' => (string)$item->description,
            'pub_date' => date('Y-m-d H:i:s', strtotime($item->pubDate)),
            'category' => (string)$item->category,
            'source' => 'KremenToday',
            'description' => ''
        ]);
    }
}
