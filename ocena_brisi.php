<?php
require_once 'baza.php';
include 'seja.php';

preveri_prijavo();

if (isset($_GET['id']) && isset($_GET['knjiga_id'])) {
    
    $ocena_id = (int)$_GET['id'];
    $knjiga_id = (int)$_GET['knjiga_id'];
    $trenutni_uporabnik = $_SESSION['idu'];
    
    if (isset($_SESSION['vloga_id']) && $_SESSION['vloga_id'] == 1) {
        $sql_brisi = "DELETE FROM ocene WHERE id = $ocena_id;";
    } else {
        $sql_brisi = "DELETE FROM ocene WHERE id = $ocena_id AND uporabnik_id = $trenutni_uporabnik;";
    }
    
    if (mysqli_query($link, $sql_brisi)) {
        header("Location: ocene.php?id=" . $knjiga_id);
        exit();
    } else {
        echo "Napaka: " . mysqli_error($link);
    }
    
} else {
    header("Location: seznam_knjig.php");
    exit();
}
?>