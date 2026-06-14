<?php
require_once 'baza.php';
include 'seja.php';

preveri_prijavo();

$uporabnik_id = (int)$_SESSION['idu']; 
$knjiga_id = (int)$_POST['knjiga_id'];
$status = $_POST['status']; 

$sql = "INSERT INTO UPORABNIK_KNJIGE (uporabnik_id, knjiga_id, status) 
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE status = ?";

$stmt = mysqli_prepare($link, $sql);

mysqli_stmt_bind_param($stmt, "iiss", $uporabnik_id, $knjiga_id, $status, $status);

if (mysqli_stmt_execute($stmt)) {
    header("Location: seznam_mojih.php");
} else {
    echo "Napaka pri shranjevanju na seznam.";
}

mysqli_stmt_close($stmt);
?>