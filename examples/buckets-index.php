<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('apikey' => $apiKey));
$buckets = $client->buckets->index();
echo "\nDisplaying {$buckets->count} records per page:\n";
echo "\nPage: " . $buckets->page . ' of ' . $buckets->getPageCount() . "\n";
foreach($buckets as $bucket) {
    echo $bucket->name . "\n";
}
while ($buckets->hasMorePages()) {
    $itempage = $buckets->getNextPage();
    echo "\nPage: " . $buckets->page . ' of ' . $buckets->getPageCount() . "\n";
    foreach($itempage as $bucket) {
        echo $bucket->name . "\n";
    }
}
