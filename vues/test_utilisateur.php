<?php
require_once '../controleurs/UtilisateurControleur.php';

$controleur = new UtilisateurControleur();
$username = 'testuser_' . time();

// Test de création d'utilisateur
$creation = $controleur->creerUtilisateur($username, 'testpassword', 'Nom', 'Prenom', 1);
if ($creation) {
    echo "Utilisateur créé avec succès.";
} else {
    echo "Erreur lors de la création de l'utilisateur.";
}

// Test de connexion d'utilisateur
$connexion = $controleur->connexionUtilisateur($username, 'testpassword');
if ($connexion) {
    echo "Connexion réussie.";
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}
?>
