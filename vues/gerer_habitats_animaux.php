<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Administrateur') {
    header("Location: connexion.php");
    exit();
}

require_once '../src/config/db.php';

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    $query = "SELECT * FROM habitat";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT animal.*, race.label AS espece, habitat.nom AS habitat
                FROM animal
                JOIN race ON animal.race_id = race.race_id
                JOIN habitat ON animal.habitat_id = habitat.habitat_id";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM race";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $races = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Gérer Habitats et Animaux - Arcadia Zoo</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
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
        <h2>Gérer Habitats et Animaux</h2>

        <!-- Gestion des habitats -->
        <div class="section">
            <h3>Habitats</h3>
            <form action="../controleurs/traiter_habitats.php" method="post">
                <input type="hidden" name="action" value="create">
                <div class="form-groupe">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-groupe">
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Ajouter Habitat</button>
            </form>

            <hr>

            <h4>Liste des Habitats</h4>
            <?php foreach ($habitats as $habitat): ?>
                <div class="habitat-card">
                    <form action="../controleurs/traiter_habitats.php" method="post">
                        <input type="hidden" name="habitat_id" value="<?= htmlspecialchars($habitat['habitat_id']); ?>">
                        <input type="hidden" name="action" value="update">
                        <div class="form-groupe">
                            <label for="nom_<?= htmlspecialchars($habitat['habitat_id']); ?>">Nom :</label>
                            <input type="text" id="nom_<?= htmlspecialchars($habitat['habitat_id']); ?>" name="nom" value="<?= htmlspecialchars($habitat['nom']); ?>" required>
                        </div>
                        <div class="form-groupe">
                            <label for="description_<?= htmlspecialchars($habitat['habitat_id']); ?>">Description :</label>
                            <textarea id="description_<?= htmlspecialchars($habitat['habitat_id']); ?>" name="description" required><?= htmlspecialchars($habitat['description']); ?></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Mettre à jour</button>
                    </form>
                    <form action="../controleurs/traiter_habitats.php" method="post" style="display:inline;">
                        <input type="hidden" name="habitat_id" value="<?= htmlspecialchars($habitat['habitat_id']); ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="delete-btn">Supprimer</button>
                    </form>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>

        <!-- Gestion des animaux -->
        <div class="section">
            <h3>Animaux</h3>
            <form action="../controleurs/traiter_animaux.php" method="post">
                <input type="hidden" name="action" value="create">
                <div class="form-groupe">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div class="form-groupe">
                    <label for="race_id">Race :</label>
                    <select id="race_id" name="race_id" required>
                        <?php foreach ($races as $race): ?>
                            <option value="<?= htmlspecialchars($race['race_id']); ?>"><?= htmlspecialchars($race['label']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-groupe">
                    <label for="habitat_id">Habitat :</label>
                    <select id="habitat_id" name="habitat_id" required>
                        <?php foreach ($habitats as $habitat): ?>
                            <option value="<?= htmlspecialchars($habitat['habitat_id']); ?>"><?= htmlspecialchars($habitat['nom']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Ajouter Animal</button>
            </form>

            <hr>

            <h4>Liste des Animaux</h4>
            <?php foreach ($animals as $animal): ?>
                <div class="animal-card">
                    <form action="../controleurs/traiter_animaux.php" method="post">
                        <input type="hidden" name="animal_id" value="<?= htmlspecialchars($animal['animal_id']); ?>">
                        <input type="hidden" name="action" value="update">
                        <div class="form-groupe">
                            <label for="prenom_<?= htmlspecialchars($animal['animal_id']); ?>">Prénom :</label>
                            <input type="text" id="prenom_<?= htmlspecialchars($animal['animal_id']); ?>" name="prenom" value="<?= htmlspecialchars($animal['prenom']); ?>" required>
                        </div>
                        <div class="form-groupe">
                            <label for="race_id_<?= htmlspecialchars($animal['animal_id']); ?>">Race :</label>
                            <select id="race_id_<?= htmlspecialchars($animal['animal_id']); ?>" name="race_id" required>
                                <?php foreach ($races as $race): ?>
                                    <option value="<?= htmlspecialchars($race['race_id']); ?>" <?= $race['race_id'] == $animal['race_id'] ? 'selected' : ''; ?>><?= htmlspecialchars($race['label']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-groupe">
                            <label for="habitat_id_<?= htmlspecialchars($animal['animal_id']); ?>">Habitat :</label>
                            <select id="habitat_id_<?= htmlspecialchars($animal['animal_id']); ?>" name="habitat_id" required>
                                <?php foreach ($habitats as $habitat): ?>
                                    <option value="<?= htmlspecialchars($habitat['habitat_id']); ?>" <?= $habitat['habitat_id'] == $animal['habitat_id'] ? 'selected' : ''; ?>><?= htmlspecialchars($habitat['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="submit-btn">Mettre à jour</button>
                    </form>
                    <form action="../controleurs/traiter_animaux.php" method="post" style="display:inline;">
                        <input type="hidden" name="animal_id" value="<?= htmlspecialchars($animal['animal_id']); ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="delete-btn">Supprimer</button>
                    </form>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>

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
</body>
</html>
