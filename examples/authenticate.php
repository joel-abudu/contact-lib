<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(
            array('email' => $email, 'password' => $password)
        );
$client = new Services_Contactually(array('apikey' => $apiKey));
print_r($client);
