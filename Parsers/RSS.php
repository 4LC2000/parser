<?php
namespace Parsers;
class RSS
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
    protected function parseItem(\SimpleXMLElement $item): void
    {
        $this->setItem([
            'title'=>(string)$item->title,
            'link'=>(string)$item->link,
            'description'=>(string)$item->description,
            'category'=>(string)$item->category,
            'pub_date'=>date('Y-m-d H:i:s',strtotime($item->pubDate)),

        ]);
    }
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
                           