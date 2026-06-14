<?php
require 'baza.php';

$i  = $_POST['ime'];
$prii  = $_POST['priimek'];
$user  = $_POST['uporabnisko_ime'];
$mail  = $_POST['email'];
$geslo  = $_POST['geslo'];

$geslo_hash = password_hash($geslo, PASSWORD_DEFAULT);
$vloga_id = 2; 

$sql = "INSERT INTO uporabniki (uporabnisko_ime, email, geslo_hash, ime, priimek, vloga_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($link, $sql);

mysqli_stmt_bind_param($stmt, "sssssi", $user, $mail, $geslo_hash, $i, $prii, $vloga_id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: prijava.php");
    exit();
} else {
    echo 'Registracija neuspešna: ' . mysqli_error($link);
    header('Refresh: 2; url=registracija.php');
}

mysqli_stmt_close($stmt);
?>