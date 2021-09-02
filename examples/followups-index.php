<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('apikey' => $apiKey));
$followups = $client->followups->index();
foreach($followups as $followup) {
    echo $followup->title . " " . $followup->due_date . "\n";
}
