<?php
require_once '../controleurs/AvisControleur.php';

$avisControleur = new AvisControleur();
$avisControleur->creerAvis("Jean", "Super zoo, à visiter absolument !");
$avis = $avisControleur->lireAvis();
print_r($avis);
$avisControleur->validerAvis(1);
?>
