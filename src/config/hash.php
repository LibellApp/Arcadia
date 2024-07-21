<?php
$plain_password = 'ArcaAdmin';
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
echo $hashed_password;