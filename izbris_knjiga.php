<?php
require_once 'baza.php';

preveri_admina();

$knjiga_id = (int)$_GET['id'];

$sql_avtorji = "DELETE FROM knjige_avtorji WHERE knjiga_id = $knjiga_id";
mysqli_query($link, $sql_avtorji);
$sql_zanri = "DELETE FROM knjige_zanri WHERE knjiga_id = $knjiga_id";
mysqli_query($link, $sql_zanri);

$sql_knjiga = "DELETE FROM knjige WHERE id = $knjiga_id";
mysqli_query($link, $sql_knjiga);

header("Location: seznam_knjig.php");
exit(); 
?>