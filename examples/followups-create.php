<?php
include_once '../creds.php';
include_once '../vendor/autoload.php';
$client = new \Contactually\Client($apikey);
$result = $client->followups->create($params);
echo $result;
