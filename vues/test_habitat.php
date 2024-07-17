<?php
require_once '../controleurs/HabitatControleur.php';

$habitatControleur = new HabitatControleur();
$habitatControleur->creerHabitat("Savane", "Habitat pour les animaux de la savane.");
$habitats = $habitatControleur->lireHabitats();
print_r($habitats);
$habitatControleur->mettreAJourHabitat(1, "Savane Modifiée", "Description modifiée.");
$habitatControleur->supprimerHabitat(1);
?>
