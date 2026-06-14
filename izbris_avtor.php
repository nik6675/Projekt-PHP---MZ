<?php
require_once 'baza.php';

preveri_admina();

$avtor_id = (int)$_GET['id'];

$sql_vezi = "DELETE FROM knjige_avtorji WHERE avtor_id = $avtor_id";
mysqli_query($link, $sql_vezi);

$sql_avtor = "DELETE FROM avtorji WHERE id = $avtor_id";
mysqli_query($link, $sql_avtor);

header("Location: seznam_avtorjev.php");
exit(); 
?>