<?php

namespace Parsers;

abstract class RSS
{
    protected $items = [];
    protected $url;
    protected $document;

    public function __construct($url)
    {
        $this->url = $url;
        $this->document = new \SimpleXMLElement(
            $this->url,
            0,
            true
        );
    }
    public function getItems(): array
    {
        return $this->items;
    }
    protected function setItem(array $item): void
    {
        $this->items[] = $item;
    }
    abstract protected function parseItem(\SimpleXMLElement $item): void;
    
    public function parse(): RSS
    {
        $RSSdocument = get_object_vars($this->document->channel->children());
        foreach ($RSSdocument['item'] as $item) {
            $this->parseItem($item);
        }

        return $this;
    }
};



 // foreach ($itemValue as $enclosureValues) {
                            //     $enclosureItem = get_object_vars($enclosureValues);

                                // foreach($enclosureItem as $ecnKeys => $encValue){
                                //     print_r($enclosureItem);
                                // }
                                // array_push($enclosureArray['enclosure'], $enclosureItem['@attributes']);
                            // }
