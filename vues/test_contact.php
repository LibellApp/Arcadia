<?php
require_once '../controleurs/ContactControleur.php';

$contactControleur = new ContactControleur();
$contactControleur->creerContact("Demande d'information", "Je souhaite obtenir plus d'informations sur les horaires.", "visiteur@example.com");
$contacts = $contactControleur->lireContacts();
print_r($contacts);
?>
