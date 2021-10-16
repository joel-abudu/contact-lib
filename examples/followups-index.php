<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('apikey' => $apiKey));
$followups = $client->followups->index();
echo "\nDisplaying {$followups->count} records:\n";
foreach($followups as $followup) {
    echo $followup->title . " " . $followup->due_date . "\n";
}
