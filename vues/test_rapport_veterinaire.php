<?php
require_once '../controleurs/RapportVeterinaireControleur.php';

$rapportVeterinaireControleur = new RapportVeterinaireControleur();
$rapportVeterinaireControleur->creerRapport(3, 1, '2024-07-17', 'Animal en bonne santé', 'foin', '5kg'); // Utilisez l'ID de l'animal créé (3)
$rapports = $rapportVeterinaireControleur->lireRapports();
print_r($rapports);
?>
