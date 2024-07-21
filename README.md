# Arcadia Zoo - Déploiement Local

## Prérequis

- [XAMPP](https://www.apachefriends.org/index.html) (qui inclut Apache et MySQL)
- [Visual Studio Code](https://code.visualstudio.com/) ou tout autre éditeur de code
- Un navigateur web (comme Chrome, Firefox, etc.)## Étapes de Déploiement

### 1. Cloner le Dépôt

Clonez le dépôt de votre projet à partir de votre système de contrôle de version (par exemple, GitHub) en utilisant la commande suivante :

git clone https://github.com/LibellApp/Arcadia

Démarrer XAMPP :

    Ouvrez XAMPP Control Panel et démarrez les services Apache et MySQL.

Configurer la base de données :

    Accédez à phpMyAdmin dans votre navigateur.

    Créez une nouvelle base de données nommée arcadia_zoo.

    Importez le fichier SQL contenant la structure de la base de données et les données initiales :

        Cliquez sur l'onglet "Import".
        Sélectionnez le fichier arcadia_zoo.sql situé dans le dossier Arcadia\src\config.
        Importer le fichier.

Configurer le projet :

    Copiez les fichiers du projet dans le répertoire htdocs de XAMPP :
        C:\xampp\htdocs sous Windows.
        Créez un dossier nommé arcadia_zoo et copiez-y les fichiers du projet.

Accéder à l'application :

    Ouvrez votre navigateur web.
    Accédez à l'application en tapant l'URL suivante : http://localhost/arcadia_zoo/vues/index.php
