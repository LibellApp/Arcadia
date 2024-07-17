<?php
require 'vendor/autoload.php'; // Inclut les dépendances installées par Composer

class MongoDBConnection {
    private $client;
    private $database;

    public function __construct() {
        $this->client = new MongoDB\Client("mongodb://localhost:27017");
        $this->database = $this->client->arcadia_zoo;
    }

    public function getDatabase() {
        return $this->database;
    }
}