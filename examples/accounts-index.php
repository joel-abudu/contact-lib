<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('apikey' => $apiKey));
$accounts = $client->accounts->index();
foreach($accounts as $account) {
    echo $account->username . "\n";
    echo $account->type . "\n";
}