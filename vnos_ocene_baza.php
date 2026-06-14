<?php
require_once 'baza.php';
include 'seja.php';

preveri_prijavo();

if (!empty($_POST)) {
    $uporabnik_id = (int)$_SESSION['idu'];
    $knjiga_id = (int)$_POST['knjiga_id'];
    $ocena = (int)$_POST['ocena'];
    $mnenje = $_POST['mnenje'];

    $sql = "INSERT INTO ocene (ocena, mnenje, uporabnik_id, knjiga_id) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    
    mysqli_stmt_bind_param($stmt, "isii", $ocena, $mnenje, $uporabnik_id, $knjiga_id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: ocene.php?id=" . $knjiga_id);
        exit();
    } else {
        echo "Napaka pri shranjevanju ocene.";
        mysqli_stmt_close($stmt);
    }
} else {
    header("Location: seznam_knjig.php");
    exit();
}
?>