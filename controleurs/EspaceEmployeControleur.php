<?php
require_once '../config/db.php';
require_once '../modeles/Avis.php';

class EspaceEmployeControleur {
    private $db;
    private $avis;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->avis = new Avis($this->db);
    }

    public function validerAvis($id) {
        $this->avis->id = $id;

        if ($this->avis->valider()) {
            echo "Avis validé avec succès.";
        } else {
            echo "Erreur lors de la validation de l'avis.";
        }
    }
}

// Exemple d'utilisation :
// $employeControleur = new EspaceEmployeControleur();
// $employeControleur->validerAvis(1);
?>
