<?php
require_once '../config/mongodb.php';

class ConsultationControleur {
    private $db;

    public function __construct() {
        $this->db = (new MongoDBConnection())->getDatabase();
    }

    public function enregistrerConsultation($animal_id) {
        $collection = $this->db->consultations;
        $consultation = $collection->findOne(['animal_id' => $animal_id]);

        if ($consultation) {
            $collection->updateOne(
                ['animal_id' => $animal_id],
                ['$inc' => ['compteur' => 1]]
            );
        } else {
            $collection->insertOne([
                'animal_id' => $animal_id,
                'compteur' => 1
            ]);
        }
    }
}

// Exemple d'utilisation :
// $consultationControleur = new ConsultationControleur();
// $consultationControleur->enregistrerConsultation(1);
