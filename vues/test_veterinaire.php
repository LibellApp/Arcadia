<?php
require_once '../controleurs/EspaceVeterinaireControleur.php';

$veterinaireControleur = new EspaceVeterinaireControleur();
$veterinaireControleur->creerRapport(3, 1, '2024-07-17', 'Animal en bonne santé', 'foin', '5kg'); // Assurez-vous que l'animal_id (3) et le veterinaire_id (1) existent
$rapports = $veterinaireControleur->lireRapports();
print_r($rapports);
?>
