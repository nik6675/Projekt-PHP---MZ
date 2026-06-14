<?php
require_once 'baza.php';

$ime = $_POST['ime'];
$priimek = $_POST['priimek'];
$leto_rojstva = (int)$_POST['leto_rojstva'];
$drzava = $_POST['drzava'];

$ime_slike = nalozi_sliko('slika', 'default_avtor.png');

$sql = "INSERT INTO avtorji (ime, priimek, leto_rojstva, drzava, slika) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "ssiss", $ime, $priimek, $leto_rojstva, $drzava, $ime_slike);

if (mysqli_stmt_execute($stmt)) {
    echo "Avtor uspešno dodan!";
    header("Refresh: 2; url=seznam_avtorjev.php");
} else {
    echo "Napaka pri dodajanju avtorja.";
    echo "<br><a href='vnos_avtor.php'>Poskusi znova</a>";
}

mysqli_stmt_close($stmt);
?>