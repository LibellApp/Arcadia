<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitats - Arcadia Zoo</title>
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
            <h2>Les différents habitats d'Arcadia</h2>
            <p>Bienvenue dans le majestueux espace zoologique d'Arcadia, où la nature et l'écologie se rencontrent pour offrir une expérience inoubliable.</p>
            <p>Chaque enclos et habitat est conçu pour reproduire au mieux l'environnement naturel de ses résidents, assurant leur bien-être et offrant aux visiteurs une immersion totale dans la beauté de la faune sauvage. Explorez et découvrez la diversité incroyable de notre monde animal dans le respect de la nature et de l'écologie.</p>
        </section>

        <section class="habitat">
            <h2>La savane d'Arcadia</h2>
            <img class="big" src="../src/images/habitats/enclot-savane-2.webp" alt="Savane">
            <p>La savane d'Arcadia est une vaste étendue parsemée d'acacias et d'herbes hautes, recréant fidèlement l'écosystème des plaines africaines. Les visiteurs peuvent observer les interactions fascinantes des animaux emblématiques de la savane dans un environnement spacieux et naturel.</p>
            <div class="habitat-grille">
                <div class="habitat-item">
                    <img src="../src/images/WEBP/giraffe.webp" alt="Girafes">
                    <div class="habitat-text">Enclos des Girafes :</div>
                    <p>Admirez la grâce des girafes qui se déplacent élégamment dans leur vaste enclos, avec des arbres à leur hauteur pour satisfaire leur appétit.</p>
                </div>
                <div class="habitat-item">
                    <img src="../src/images/WEBP/elephan.webp" alt="Éléphants">
                    <div class="habitat-text">Enclos des Éléphants :</div>
                    <p>Découvrez la puissance et la sagesse des éléphants, dans un habitat spacieux conçu pour reproduire leur environnement naturel.</p>
                </div>
                <div class="habitat-item">
                    <img src="../src/images/WEBP/suricates.webp" alt="Suricates">
                    <div class="habitat-text">Enclos des Suricates :</div>
                    <p>Les suricates espiègles et sociables vous divertiront avec leurs postures caractéristiques et leur vie de groupe fascinante.</p>
                </div>
            </div>
        </section>

        <section class="habitat">
            <h2>La jungle d'Arcadia</h2>
            <img class="big" src="../src/images/habitats/enclot-jungle.webp" alt="Jungle">
            <p>Plongez dans la jungle luxuriante d'Arcadia, un environnement dense et verdoyant où l'humidité et la chaleur créent un habitat idéal pour une diversité impressionnante d'animaux tropicaux. Ce biome recrée les forêts tropicales denses, offrant un refuge naturel à ses résidents.</p>
            <div class="habitat-grille">
                <div class="habitat-item">
                    <img src="../src/images/WEBP/tigre.webp" alt="Tigres">
                    <div class="habitat-text">Enclos des Tigres :</div>
                    <p>Ressentez l'émotion en observant les tigres majestueux, symboles de puissance et de beauté, évoluant dans un espace sécurisé et adapté à leurs besoins.</p>
                </div>
                <div class="habitat-item">
                    <img src="../src/images/WEBP/singes.webp" alt="Singes">
                    <div class="habitat-text">Enclos des Singes :</div>
                    <p>Appréciez les acrobaties et les interactions sociales des singes, toujours actifs et curieux.</p>
                </div>
                <div class="habitat-item">
                    <img src="../src/images/WEBP/iguane.webp" alt="Reptiles">
                    <div class="habitat-text">Espace des Reptiles :</div>
                    <p>L'espace des reptiles offre une expérience éducative et immersive où les visiteurs peuvent découvrir des créatures exotiques dans des terrariums recréant fidèlement leurs habitats naturels.</p>
                </div>
            </div>
        </section>

        <section class="habitat">
            <h2>L'espace aquatique d'Arcadia</h2>
            <img class="big" src="../src/images/habitats/aquarium-2.webp" alt="Espace aquatique">
            <p>L'écosystème aquatique d'Arcadia est une merveille sous-marine où la diversité marine est célébrée dans des aquariums soigneusement conçus. Plongez dans un monde d'eau où les créatures marines cohabitent dans des environnements spectaculaires qui simulent leurs habitats naturels.</p>
            <div class="habitat-grille">
                <div class="habitat-item">
                    <img src="../src/images/WEBP/aquarium.webp" alt="Grand aquarium">
                    <div class="habitat-text">Le grand aquarium :</div>
                    <p>Un immense aquarium abrite une diversité de vie marine, des requins majestueux aux poissons colorés, en passant par les orques et les dauphins joueurs.</p>
                </div>
                <div class="habitat-item">
                    <img src="../src/images/WEBP/raie_a_points_bleus.webp" alt="Raies">
                    <div class="habitat-text">Les raies :</div>
                    <p>Admirez la grâce des raies mantas, nageant élégamment dans leur espace dédié.</p>
                </div>
                <div class="habitat-item">
                    <img src="../src/images/WEBP/tortue.webp" alt="Tortues">
                    <div class="habitat-text">Espace des Tortues :</div>
                    <p>Découvrez les tortues évoluant tranquillement dans leur habitat et se prélassant paisiblement sous le soleil.</p>
                </div>
            </div>
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
