<?php
require_once '../config/db.php';
require_once '../modeles/Commentaire.php';

class CommentaireControleur {
    private $db;
    private $commentaire;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->commentaire = new Commentaire($this->db);
    }

    public function soumettreCommentaire($nom_utilisateur, $commentaire) {
        $this->commentaire->nom_utilisateur = $nom_utilisateur;
        $this->commentaire->commentaire = $commentaire;

        if ($this->commentaire->soumettre()) {
            echo "Commentaire soumis avec succès.";
        } else {
            echo "Erreur lors de la soumission du commentaire.";
        }
    }

    public function lireCommentaires() {
        $stmt = $this->commentaire->lireTous();
        $commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $commentaires;
    }

    public function validerCommentaire($id) {
        $this->commentaire->id = $id;

        if ($this->commentaire->valider()) {
            echo "Commentaire validé avec succès.";
        } else {
            echo "Erreur lors de la validation du commentaire.";
        }
    }
}

// Exemple d'utilisation :
// $commentaireControleur = new CommentaireControleur();
// $commentaireControleur->soumettreCommentaire("nom_utilisateur", "commentaire");
// $commentaires = $commentaireControleur->lireCommentaires();
// print_r($commentaires);
// $commentaireControleur->validerCommentaire(1);
?>
