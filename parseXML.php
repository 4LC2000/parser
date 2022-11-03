<?php

class ParseXML
{
    public $arrNews = [];
    public $arrImg = [];

    protected $url;
    protected $document;

    public function __construct($url)
    {
        $this->url = $url;
        $this->document = new SimpleXMLElement(
            $this->url,
            0,
            true
        );
    }

    public function parse()
    {
        $channelChildren = $this->document->channel->children();
        $channelChildrenProp = get_object_vars($channelChildren);
        foreach ($channelChildrenProp as $k => $val) {
            if ($k === 'item') {
                $newsItem = [];

                foreach ($val as $itemKeysValue){
                    $itemKeysArray = get_object_vars($itemKeysValue);
                    $enclosureArray = [
                        'enclosure' => []
                    ];

                    foreach ($itemKeysArray as $q => $itemValue) {
                        if ($q === 'enclosure') {
                            // foreach ($itemValue as $enclosureValues) {
                            //     $enclosureItem = get_object_vars($enclosureValues);

                                // foreach($enclosureItem as $ecnKeys => $encValue){
                                //     print_r($enclosureItem);
                                // }
                                // array_push($enclosureArray['enclosure'], $enclosureItem['@attributes']);
                            // }
                            continue;
                        }

                        $newsItem[$q] = $itemValue;
                    }

                    $newsItem = array_merge($newsItem, $enclosureArray);
                    array_push($this->arrNews, $newsItem);
                }
            }
        }
        return $this->arrNews;
    }
};

