<?php
#require 'vendor/autoload.php';
require __DIR__ . '/vendor/autoload.php';
$host = 'mongodb';
$dbname = 'test_db';

// Set up a MongoDB connection to the database
try {
    $mongo = new MongoDB\Client("mongodb://$host");
    $db = $mongo->$dbname;
    echo "Connected to database $dbname \n";
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}

printf("\n");
printf("\n");

use Elastic\Elasticsearch\ClientBuilder;


$client = ClientBuilder::create()
    ->setHosts(['elasticsearch:9200'])
    ->build();

if ($client->ping()) {
    echo "Connected to Elasticsearch successfully.";
} else {
    echo "Failed to connect to Elasticsearch.";
}

?>