<?php
include_once '../creds.php';
include_once '../vendor/autoload.php';
$client = new \Contactually\Client($apikey);
$result = $client->groupings->create($params);
echo $result;
