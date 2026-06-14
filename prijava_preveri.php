<?php
require_once 'baza.php';
include 'seja.php'; 

$user = $_POST['uporabnisko_ime'];
$geslo = $_POST['geslo'];

$sql = "SELECT * FROM uporabniki WHERE uporabnisko_ime = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_array($result);
    
    if (password_verify($geslo, $row['geslo_hash'])) {
        $_SESSION['idu'] = $row['id']; 
        $_SESSION['uporabnisko_ime'] = $row['uporabnisko_ime'];
        $_SESSION['vloga_id'] = $row['vloga_id'];
        $_SESSION['slika'] = $row['slika'];
        
        header("Location: index.php");
        exit();
    } else {
        echo "Napačno geslo.";
        header("Refresh: 2; url=prijava.php");
    }
} else {
    echo "Uporabnik ne obstaja.";
    header("Refresh: 2; url=prijava.php");
}

mysqli_stmt_close($stmt);
?>