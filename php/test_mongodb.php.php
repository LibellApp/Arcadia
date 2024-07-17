<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->test->users;

$result = $collection->insertOne([
    'name' => 'Alice',
    'email' => 'alice@example.com',
]);

echo "Inserted with Object ID '{$result->getInsertedId()}'";
?>