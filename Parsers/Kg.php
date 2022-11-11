<?php

namespace Parsers;

class Kg extends RSS
{
    protected function parseItem(\SimpleXMLElement $item): void
    {
        $namespaces = $this->document->getNamespaces(true);

        $this->setItem([
            'title' => (string)$item->title,
            'link' => (string)$item->link,
            'description' => (string)$item->description,
            'source' => (string)$item->source,
            'full_text' => (string)$item->children($namespaces['yandex']),
            'pub_date' => date('Y-m-d H:i:s', strtotime($item->pubDate)),
        ]);
    }
}
