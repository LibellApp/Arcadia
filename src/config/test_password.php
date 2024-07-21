<?php
$plain_password = 'ArcaAdmin';
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
echo "Hashed password: " . $hashed_password . "\n";

if (password_verify($plain_password, $hashed_password)) {
    echo "Password is valid!";
} else {
    echo "Invalid password.";
}
?>
