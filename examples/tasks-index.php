<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('apikey' => $apiKey));
$tasks = $client->tasks->index($page = 1, $limit = 10);
echo "\nDisplaying {$tasks->count} records per page:\n";
echo "\nPage: " . $tasks->page . ' of ' . $tasks->getPageCount() . "\n";
foreach($tasks as $task) {
    echo $task->title . "\n";
    echo $task->due_date . "\n";
}
while ($tasks->hasMorePages()) {
    $itempage = $tasks->getNextPage();
    echo "\nPage: " . $tasks->page . ' of ' . $tasks->getPageCount() . "\n";
    foreach($itempage as $task) {
        echo $task->title . "\n";
        echo $task->due_date . "\n";
    }
}
