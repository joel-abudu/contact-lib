<?php
include_once '../creds.php';
include_once '../Services/Contactually.php';
$client = new Services_Contactually(array('apikey' => $apiKey));
$tasks = $client->tasks->index();
echo "\nDisplaying {$tasks->count} records:\n";
foreach($tasks as $task) {
    echo $task->title . "\n";
    echo $task->due_date . "\n";
}
