<?php
require_once '../config/db.php';
require_once '../modeles/RapportVeterinaire.php';

class EspaceVeterinaireControleur {
    private $db;
    private $rapportVeterinaire;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->rapportVeterinaire = new RapportVeterinaire($this->db);
    }

    public function creerRapport($animal_id, $veterinaire_id, $date_rapport, $texte_rapport, $nourriture, $quantite_nourriture) {
        $this->rapportVeterinaire->animal_id = $animal_id;
        $this->rapportVeterinaire->veterinaire_id = $veterinaire_id;
        $this->rapportVeterinaire->date_rapport = $date_rapport;
        $this->rapportVeterinaire->texte_rapport = $texte_rapport;
        $this->rapportVeterinaire->nourriture = $nourriture;
        $this->rapportVeterinaire->quantite_nourriture = $quantite_nourriture;

        if ($this->rapportVeterinaire->creer()) {
            echo "Rapport vétérinaire créé avec succès.";
        } else {
            echo "Erreur lors de la création du rapport vétérinaire.";
        }
    }

    public function lireRapports() {
        $stmt = $this->rapportVeterinaire->lireTous();
        $rapports = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rapports;
    }
}

// Exemple d'utilisation :
// $veterinaireControleur = new EspaceVeterinaireControleur();
// $veterinaireControleur->creerRapport(1, 1, '2024-07-17', 'Animal en bonne santé', 'foin', '5kg');
// $rapports = $veterinaireControleur->lireRapports();
// print_r($rapports);
?>
