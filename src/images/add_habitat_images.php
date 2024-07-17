<?php
require_once '../../config/db.php'; // Ajuster le chemin en fonction de l'arborescence

class ImageControleur {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function ajouterImage($imagePath, $habitatId) {
        $query = "INSERT INTO image (image_path, habitat_id) VALUES (:image_path, :habitat_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':image_path', $imagePath);
        $stmt->bindParam(':habitat_id', $habitatId);
        return $stmt->execute();
    }
}

// Exemple d'ajout d'images
$imageControleur = new ImageControleur();
$imageControleur->ajouterImage('src/images/enclot_savane.jpg', 1);
$imageControleur->ajouterImage('src/images/enclot_jungle.jpg', 2);
$imageControleur->ajouterImage('src/images/enclot_aquarium.jpg', 3);

echo "Images ajoutées avec succès.";
?>
