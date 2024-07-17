<?php
require_once '../config/db.php';
require_once '../modeles/Utilisateur.php';

class ConnexionControleur {
    public function connexion($nom_utilisateur, $mot_de_passe) {
        $database = new Database();
        $db = $database->getConnection();

        $utilisateur = new Utilisateur($db);
        $utilisateur->nom_utilisateur = $nom_utilisateur;
        $utilisateur->mot_de_passe = $mot_de_passe;

        if ($utilisateur->connexion()) {
            echo "Connexion réussie.";
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
}

// Exemple d'utilisation :
// $connexionControleur = new ConnexionControleur();
// $connexionControleur->connexion("nom_utilisateur", "mot_de_passe");