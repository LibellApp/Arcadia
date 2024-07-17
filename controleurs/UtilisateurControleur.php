<?php
require_once '../modeles/Utilisateur.php';

class UtilisateurControleur {
    public function creerUtilisateur($username, $password, $nom, $prenom, $role_id) {
        $utilisateur = new Utilisateur();
        $utilisateur->username = $username;
        $utilisateur->password = $password;
        $utilisateur->nom = $nom;
        $utilisateur->prenom = $prenom;
        $utilisateur->role_id = $role_id;
        return $utilisateur->creer();
    }

    public function connexionUtilisateur($username, $password) {
        $utilisateur = new Utilisateur();
        return $utilisateur->connexion($username, $password);
    }
}
?>
