<?php
require_once 'baza.php';
include 'seja.php';

preveri_prijavo();

$uporabnik_id = $_SESSION['idu'];
$knjiga_id = (int)$_GET['id'];

$sql = "DELETE FROM UPORABNIK_KNJIGE 
        WHERE uporabnik_id = $uporabnik_id AND knjiga_id = $knjiga_id;";

if (mysqli_query($link, $sql)) {
    header("Location: seznam_mojih.php");
    exit();
} else {
    echo "Napaka pri odstranjevanju knjige s seznama: " . mysqli_error($link);
}
?>