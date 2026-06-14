<?php
require_once 'baza.php';

$naslov = $_POST['naslov'];
$leto = (int)$_POST['leto_izdaje'];
$opis = $_POST['opis'];
$avtor_id = (int)$_POST['avtor_id'];
$zanr_id = (int)$_POST['zanr_id'];

$ime_slike = nalozi_sliko('slika', 'default_knjiga.png');

$sql_k = "INSERT INTO knjige (naslov, leto_izdaje, opis, slika) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($link, $sql_k);
mysqli_stmt_bind_param($stmt, "siss", $naslov, $leto, $opis, $ime_slike);
mysqli_stmt_execute($stmt);
$knjiga_id = mysqli_insert_id($link);
mysqli_stmt_close($stmt);

$sql_a = "INSERT INTO knjige_avtorji (knjiga_id, avtor_id) VALUES (?, ?)";
$stmt_a = mysqli_prepare($link, $sql_a);
mysqli_stmt_bind_param($stmt_a, "ii", $knjiga_id, $avtor_id);
mysqli_stmt_execute($stmt_a);
mysqli_stmt_close($stmt_a);

$sql_z = "INSERT INTO knjige_zanri (knjiga_id, zanr_id) VALUES (?, ?)";
$stmt_z = mysqli_prepare($link, $sql_z);
mysqli_stmt_bind_param($stmt_z, "ii", $knjiga_id, $zanr_id);
mysqli_stmt_execute($stmt_z);
mysqli_stmt_close($stmt_z);

echo "Knjiga uspešno dodana!";
header("Refresh: 2; url=seznam_knjig.php");
?>