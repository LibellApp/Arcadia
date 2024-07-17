<?php
require_once '../config/db.php';

class Utilisateur {
    public $username;
    public $password;
    public $nom;
    public $prenom;
    public $role_id;

    public function creer() {
        $db = Database::getInstance()->getConnection();
        $query = "INSERT INTO utilisateur (username, password, nom, prenom, role_id) VALUES (:username, :password, :nom, :prenom, :role_id)";
        $stmt = $db->prepare($query);

        $stmt->bindParam(":username", $this->username);
        $hashed_password = base64_encode(hash('sha256', $this->password, true));
        echo "Mot de passe haché: " . $hashed_password . "<br>";
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":role_id", $this->role_id);

        return $stmt->execute();
    }

    public function connexion($username, $password) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM utilisateur WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur) {
            echo "Utilisateur trouvé : ";
            print_r($utilisateur);
            echo "<br>";
            $hashed_password = base64_encode(hash('sha256', $password, true));
            echo "Mot de passe fourni: " . $hashed_password . "<br>";
            echo "Mot de passe stocké: " . $utilisateur['password'] . "<br>";
            if ($hashed_password === $utilisateur['password']) {
                echo "Mot de passe vérifié avec succès.";
                return $utilisateur;
            } else {
                echo "Échec de la vérification du mot de passe.";
                return false;
            }
        } else {
            echo "Utilisateur non trouvé.";
            return false;
        }
    }
}
?>
