<?php
require_once '../config/mongodb.php';

class StatistiquesControleur {
    private $db;

    public function __construct() {
        $this->db = (new MongoDBConnection())->getDatabase();
    }

    public function lireStatistiques() {
        $collection = $this->db->consultations;
        $statistiques = $collection->find()->toArray();
        return $statistiques;
    }
}
