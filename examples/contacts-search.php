<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('apikey' => $apiKey));
$contacts = $client->contacts->search('monkey');
foreach($contacts as $contact) {
    echo $contact->first_name . " " . $contact->last_name . "\n";
    echo $contact->company . "\n";
}
