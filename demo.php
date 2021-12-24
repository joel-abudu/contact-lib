<?php
include_once 'creds.php';
include_once 'Services/Contactually.php';
echo '<pre>';
$service = new Services_Contactually(array('api_key' => $apiKey));
$results = $service->contacts(array('limit' => 10));
print_r($results);
