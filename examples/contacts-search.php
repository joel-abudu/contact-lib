<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('api_key' => $apiKey));
$contacts = $client->contacts->search('michelle', $page = 1, $limit = 20);
echo "\nDisplaying {$contacts->count} records per page:\n";
echo "\nPage: " . $contacts->page . ' of ' . $contacts->getPageCount() . "\n";
foreach($contacts as $contact) {
    echo $contact->first_name . " " . $contact->last_name . "\n";
}
while ($contacts->hasMorePages()) {
    $itempage = $contacts->getNextResults();
    echo "\nPage: " . $contacts->page . ' of ' . $contacts->getPageCount() . "\n";
    foreach($itempage as $contact) {
        echo $contact->first_name . " " . $contact->last_name . "\n";
    }
}
