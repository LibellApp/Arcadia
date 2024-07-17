<?php
require_once '../controleurs/CommentaireControleur.php';

$commentaireControleur = new CommentaireControleur();
$commentaireControleur->soumettreCommentaire("nom_utilisateur", "commentaire");

$commentaires = $commentaireControleur->lireCommentaires();
print_r($commentaires);

$commentaireControleur->validerCommentaire(1);
?>
