<?php
session_start();
require_once '../src/config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $query = "
            SELECT u.username, u.password, r.label as role
            FROM utilisateur u
            JOIN role r ON u.role_id = r.role_id
            WHERE u.username = :username
        ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            header("Location: ../vues/index.php");
            exit();
        } else {
            $_SESSION['message'] = "Nom d'utilisateur ou mot de passe incorrect.";
            header("Location: ../vues/connexion.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
        header("Location: ../vues/connexion.php");
        exit();
    }
} else {
    header("Location: ../vues/connexion.php");
    exit();
}
?> "

traiter_creation_compte.php : 

" <?php
session_start();
require_once '../src/config/db.php';
require '../php/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $role = $_POST['role'];
    $mail = $_POST['mail'];
    $identifiant = $_POST['identifiant'];
    $motdepasse = $_POST['motdepasse'];

    try {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        
        $query = "INSERT INTO utilisateur (nom, prenom, username, password, role_id) VALUES (:nom, :prenom, :identifiant, :motdepasse, (SELECT role_id FROM role WHERE label = :role))";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->bindParam(':motdepasse', $motdepasse);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

        
        $email = new PHPMailer(true);
        $email->SMTPDebug = 2;
        $email->isSMTP();
        $email->Host = 'smtp.live.com';
        $email->SMTPAuth = true;
        $email->Username = 'ArcadiaZooGO@hotmail.com';
        $email->Password = 'hiFsGm9iKxa5vZk';
        $email->SMTPSecure = 'tls';
        $email->Port = 587;

        $email->setFrom('lucas.menard.04@gmail.com', 'Arcadia Zoo');
        $email->addAddress($mail);

        $email->isHTML(true);
        $email->Subject = 'Votre compte a été créé';
        $email->Body    = 'Bonjour,<br>Votre compte de type ' . htmlspecialchars($role) . ' a été créé.<br>Votre identifiant est : ' . htmlspecialchars($identifiant) . '<br>Veuillez contacter l\'administrateur pour obtenir votre mot de passe.';

        $email->send();

        $_SESSION['message'] = "Le compte a été créé et un email a été envoyé à l'utilisateur.";
        header("Location: ../vues/creation_compte.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
        header("Location: ../vues/creation_compte.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['message'] = "Erreur lors de l'envoi de l'email : " . $e->getMessage();
        header("Location: ../vues/creation_compte.php");
        exit();
    }
} else {
    header("Location: ../vues/creation_compte.php");
    exit();
}
?>