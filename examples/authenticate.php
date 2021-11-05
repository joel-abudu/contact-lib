<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(
            array('email' => $email, 'password' => $password)
        );
echo $client->response_code;
echo "\n";
unset($client);
$client = new Services_Contactually(array('api_key' => $apiKey));
$buckets = $client->buckets->index();
foreach($buckets as $bucket) {
    echo $bucket->name . "\n";
}
