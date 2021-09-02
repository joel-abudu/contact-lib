<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('apikey' => $apiKey));
$notes = $client->notes->index();
foreach($notes as $note) {
    echo $note->body . "\n";
}
