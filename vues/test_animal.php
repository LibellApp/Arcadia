<?php
require_once '../controleurs/AnimalControleur.php';

$animalControleur = new AnimalControleur();
$animalControleur->creerAnimal("Lion", "Panthera leo", 2); // Assurez-vous que l'habitat avec id=1 existe
$animaux = $animalControleur->lireAnimaux();
print_r($animaux);
?>
