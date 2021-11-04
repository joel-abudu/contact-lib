<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('api_key' => $apiKey));
$accounts = $client->accounts->index();
echo "\nDisplaying {$accounts->count} records per page:\n";
echo "\nPage: " . $accounts->page . ' of ' . $accounts->getPageCount() . "\n";
foreach($accounts as $account) {
    echo $account->username . "\n";
    echo $account->type . "\n";
}
while ($accounts->hasMorePages()) {
    $itempage = $accounts->getNextPage();
    echo "\nPage: " . $accounts->page . ' of ' . $accounts->getPageCount() . "\n";
    foreach($itempage as $account) {
        echo $account->username . "\n";
        echo $account->type . "\n";
    }
}
