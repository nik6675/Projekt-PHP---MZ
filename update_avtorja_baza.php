<?php
require_once 'baza.php';
preveri_admina();

$id = (int)$_POST['id'];
$ime = $_POST['ime'];
$priimek = $_POST['priimek'];
$leto_rojstva = (int)$_POST['leto_rojstva'];
$drzava = $_POST['drzava'];

$ime_slike = nalozi_sliko('slika', null);

if ($ime_slike !== null) {
    $sql = "UPDATE avtorji SET ime=?, priimek=?, leto_rojstva=?, drzava=?, slika=? WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssissi", $ime, $priimek, $leto_rojstva, $drzava, $ime_slike, $id);
} else {
    $sql = "UPDATE avtorji SET ime=?, priimek=?, leto_rojstva=?, drzava=? WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssisi", $ime, $priimek, $leto_rojstva, $drzava, $id);
}

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: seznam_avtorjev.php");
?>