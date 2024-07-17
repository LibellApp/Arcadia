<?php
require_once '../config/db.php';
require_once '../modeles/Animal.php';

class AnimalControleur {
    private $db;
    private $animal;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->animal = new Animal($this->db);
    }

    public function creerAnimal($nom, $espece, $habitat_id) {
        $this->animal->nom = $nom;
        $this->animal->espece = $espece;
        $this->animal->habitat_id = $habitat_id;

        if ($this->animal->creer()) {
            echo "Animal créé avec succès.";
        } else {
            echo "Erreur lors de la création de l'animal.";
        }
    }

    public function lireAnimaux() {
        $stmt = $this->animal->lire();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $animaux;
    }
}

// Exemple d'utilisation :
// $animalControleur = new AnimalControleur();
// $animalControleur->creerAnimal("Lion", "Panthera leo", 1);
// $animaux = $animalControleur->lireAnimaux();
// print_r($animaux);
?>
