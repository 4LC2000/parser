<?php

namespace Parsers;

use Exception;

abstract class RSS
{
    protected $items = [];
    protected $url;
    protected $document;


    public function __construct(string $url)
    {
        $this->url = $url;
        $this->document = $this->getDocument();
    }
    public function getItems(): array
    {
        return $this->items;
    }
    protected function setItem(array $item): void
    {
        $this->items[] = $item;
    }

    public function parse(): RSS
    {
        $RSSdocument = get_object_vars($this->document->channel->children());
        foreach ($RSSdocument['item'] as $item) {
            $this->parseItem($item);
        }

        return $this;
    }

    protected function getDocument()
    {
        try {
            return new \SimpleXMLElement(
                $this->url,
                0,
                true
            );
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    abstract protected function parseItem(\SimpleXMLElement $item): void;
};



 // foreach ($itemValue as $enclosureValues) {
                            //     $enclosureItem = get_object_vars($enclosureValues);

                                // foreach($enclosureItem as $ecnKeys => $encValue){
                                //     print_r($enclosureItem);
                                // }
                                // array_push($enclosureArray['enclosure'], $enclosureItem['@attributes']);
                            // }
