<?php
require_once '../config/db.php';
require_once '../modeles/Contact.php';

class ContactControleur {
    private $db;
    private $contact;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->contact = new Contact($this->db);
    }

    public function creerContact($titre, $description, $courriel) {
        $this->contact->titre = $titre;
        $this->contact->description = $description;
        $this->contact->courriel = $courriel;

        if ($this->contact->creer()) {
            echo "Contact créé avec succès.";
        } else {
            echo "Erreur lors de la création du contact.";
        }
    }

    public function lireContacts() {
        $stmt = $this->contact->lireTous();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $contacts;
    }
}

// Exemple d'utilisation :
// $contactControleur = new ContactControleur();
// $contactControleur->creerContact("Demande d'information", "Je souhaite obtenir plus d'informations sur les horaires.", "visiteur@example.com");
// $contacts = $contactControleur->lireContacts();
// print_r($contacts);
?>
