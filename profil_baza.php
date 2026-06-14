<?php
require 'baza.php';
include 'seja.php'; 

preveri_prijavo("Za posodobitev profila morate biti prijavljeni.");

$id = (int)$_SESSION['idu']; 
$user = $_POST['uporabnisko_ime'];
$ime  = $_POST['ime']; 
$prii  = $_POST['priimek'];
$mail  = $_POST['email'];
$geslo  = $_POST['novo_geslo'];

$stmt_check = mysqli_prepare($link, "SELECT id FROM uporabniki WHERE uporabnisko_ime = ? AND id != ?");
mysqli_stmt_bind_param($stmt_check, "si", $user, $id);
mysqli_stmt_execute($stmt_check);
$result_check = mysqli_stmt_get_result($stmt_check);

if (mysqli_num_rows($result_check) > 0) {
    echo 'Napaka: Uporabniško ime je že zasedeno. Izberite drugo.';
    header('Refresh: 2; url=profil.php');
    exit(); 
}
mysqli_stmt_close($stmt_check);

$ima_geslo = false;
$geslo_hash = "";
if (!empty($geslo)) {
    $ima_geslo = true;
    $geslo_hash = password_hash($geslo, PASSWORD_DEFAULT); 
}

$ima_sliko = false;
$ime_slike = "";
if (isset($_FILES['slika']) && $_FILES['slika']['error'] == 0 && !empty($_FILES['slika']['name'])) {

    $rezultat_nalaganja = nalozi_sliko('slika', null);

    if ($rezultat_nalaganja !== null) {
        $ima_sliko = true;
        $ime_slike = $rezultat_nalaganja;
        $_SESSION['slika'] = $ime_slike;
    }
}

if ($ima_geslo && $ima_sliko) {
    $sql = "UPDATE uporabniki SET uporabnisko_ime=?, ime=?, priimek=?, email=?, geslo_hash=?, slika=? WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", $user, $ime, $prii, $mail, $geslo_hash, $ime_slike, $id);
} else if ($ima_geslo && !$ima_sliko) {
    $sql = "UPDATE uporabniki SET uporabnisko_ime=?, ime=?, priimek=?, email=?, geslo_hash=? WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $user, $ime, $prii, $mail, $geslo_hash, $id);
} else if (!$ima_geslo && $ima_sliko) {
    $sql = "UPDATE uporabniki SET uporabnisko_ime=?, ime=?, priimek=?, email=?, slika=? WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $user, $ime, $prii, $mail, $ime_slike, $id);
} else {
    $sql = "UPDATE uporabniki SET uporabnisko_ime=?, ime=?, priimek=?, email=? WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $user, $ime, $prii, $mail, $id);
}

if (mysqli_stmt_execute($stmt)) { 
    $_SESSION['uporabnisko_ime'] = $user;
    header("Location: index.php");
    exit(); 
} else {
    echo 'Napaka pri posodabljanju.'; 
    header('Refresh: 2; url=profil.php'); 
}
mysqli_stmt_close($stmt);
?>