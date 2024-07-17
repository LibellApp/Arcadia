<?php
require_once '../controleurs/ServiceControleur.php';

$serviceControleur = new ServiceControleur();
$serviceControleur->creerService("Visite Guidée", "Visite avec un guide expérimenté.");
$services = $serviceControleur->lireServices();
print_r($services);
$serviceControleur->mettreAJourService(1, "Visite Guidée Modifiée", "Description modifiée.");
$serviceControleur->supprimerService(1);
?>
