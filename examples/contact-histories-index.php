<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('apikey' => $apiKey));
$contact_histories = $client->contact_histories->index();
echo "\nDisplaying {$contact_histories->count} records:\n";
foreach($contact_histories as $contact_history) {
    echo $contact_history->email . "\n";
    echo $contact_history->subject . "\n";
}
