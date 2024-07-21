<?php
session_start();
require_once '../src/config/db.php';

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    $query = "
        SELECT 
            animal.animal_id, 
            animal.prenom, 
            race.label AS espece, 
            habitat.nom AS habitat, 
            etat.etat_label AS etat, 
            rapport_veterinaire.nourriture, 
            rapport_veterinaire.grammage, 
            rapport_veterinaire.date 
        FROM animal 
        JOIN race ON animal.race_id = race.race_id 
        JOIN habitat ON animal.habitat_id = habitat.habitat_id 
        JOIN rapport_veterinaire ON animal.animal_id = rapport_veterinaire.animal_id 
        JOIN etat ON rapport_veterinaire.etat_id = etat.etat_id 
        WHERE habitat.habitat_id = 2";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jungle - Arcadia Zoo</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <div class="header-content">
            <div class="logo">
                <img src="../src/images/logo/EFC_Logo_Arcadia_B_Nom.svg" alt="Arcadia Zoo">
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="habitats.php">Habitats</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="avis.php">Avis</a></li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="user-menu">
                        <span><?= htmlspecialchars($_SESSION['username']); ?></span>
                            <div class="separateur"></div>
                            <div class="menu-der">
                                <?php if ($_SESSION['role'] === 'Employé'): ?>
                                    <a href="afficher_avis_attente.php">Afficher Avis en Attente</a>
                                <?php endif; ?>
                                <?php if ($_SESSION['role'] === 'Administrateur'): ?>
                                    <a href="creation_compte.php">Créer un compte</a>
                                    <a href="modifier_services.php">Modifier les services</a>
                                    <a href="gerer_habitats_animaux.php">Gérer Habitats et Animaux</a>
                                <?php endif; ?>
                                <?php if ($_SESSION['role'] === 'Vétérinaire'): ?>
                                    <a href="suivi_veterinaire.php">Suivi Vétérinaire</a>
                                <?php endif; ?>
                                <a href="../controleurs/deconnexion.php">Se déconnecter</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li><a href="connexion.php">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <div class="content">
        <section class="habitat">
            <h2>La jungle d'Arcadia</h2>
            <img class="big" src="../src/images/habitats/enclot-jungle.webp" alt="Jungle">
            <p>Plongez dans la jungle luxuriante d'Arcadia, un environnement dense et verdoyant où l'humidité et la chaleur créent un habitat idéal pour une diversité impressionnante d'animaux tropicaux. Ce biome recrée les forêts tropicales denses, offrant un refuge naturel à ses résidents.</p>
            <?php foreach ($animals as $animal): ?>
                <div class="animal-block">
                    <?php if ($animal['animal_id'] == 5): ?>
                        <img class="habitat-item" src="C:/Users/rainbow/Documents/Travail/Code/ECF/Arcadia/src/images/WEBP/tigre.webp" alt="<?= htmlspecialchars($animal['prenom']); ?>">
                    <?php elseif ($animal['animal_id'] == 6): ?>
                        <img class="habitat-item" src="C:/Users/rainbow/Documents/Travail/Code/ECF/Arcadia/src/images/WEBP/aligator.webp" alt="<?= htmlspecialchars($animal['prenom']); ?>">
                    <?php else: ?>
                        <img class="habitat-item" src="C:/Users/rainbow/Documents/Travail/Code/ECF/Arcadia/src/images/WEBP/default.webp" alt="<?= htmlspecialchars($animal['prenom']); ?>">
                    <?php endif; ?>
                    <div class="animal-info">
                        <p><strong>Nom :</strong> <?= htmlspecialchars($animal['prenom']); ?></p>
                        <p><strong>Race :</strong> <?= htmlspecialchars($animal['espece']); ?></p>
                        <p><strong>État :</strong> <?= htmlspecialchars($animal['etat']); ?></p>
                        <p><strong>Nourriture :</strong> <?= htmlspecialchars($animal['nourriture']); ?></p>
                        <p><strong>Grammage :</strong> <?= htmlspecialchars($animal['grammage']); ?></p>
                        <p><strong>Date :</strong> <?= htmlspecialchars($animal['date']); ?></p>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        </section>

        <footer>
            <div class="footer-content">
                <p>Parc Zoologique de Arcadia<br>
                42, rue Golden Order<br>
                35000 Lindell - France<br>
                tel : 02 ** ** ** **</p>
                <div class="footer-logo">
                    <img src="../src/images/logo/EFC_Logo_Arcadia_B_Nom.svg" alt="Arcadia Zoo">
                </div>
            </div>
            <div class="footer-pdp">
                <p>&copy; 2024 Arcadia Zoo. Tous droits réservés.</p>
                <a href="#">Haut de page</a>
            </div>
        </footer>
    </div>
</body>
</html>
