<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('apikey' => $apiKey));
$buckets = $client->buckets->index();
foreach($buckets as $bucket) {
    echo $bucket->name . "\n";
}
