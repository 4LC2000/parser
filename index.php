<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);


use DevCoder\DotEnv;

$absolutePathToEnvFile = __DIR__ . '/.env';

(new DotEnv($absolutePathToEnvFile))->load();

require_once('parseXML.php');
// require_once('config.php');
require_once('DB_functionality.php');

$telegraphParser = new ParseXML(Config::get('application')->url);
$news = $telegraphParser->parse();

$createNewRecord = new DB_functionality();
foreach($news as $val)
{
    $values = [$val['title'], $val['link'], $val['description'], date("Y-m-d H:i:s", strtotime($val['pubDate']))];
    $createNewRecord->create($values);
}
$readNewRecord = new DB_functionality();
echo '<pre>';
$readNewRecord->read();

$updateRecord = new DB_functionality;
// $updateRecord->update(313, 'title', 1);

$deleteRecord = new DB_functionality;
// $deleteRecord->delete(313);

