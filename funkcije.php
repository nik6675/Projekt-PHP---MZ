<?php

function preveri_admina() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['vloga_id']) || $_SESSION['vloga_id'] != 1) {
        die("Nimate pravic za to operacijo!");
    }
}

function nalozi_sliko($polje_ime, $privzeta_slika = 'default.png') {
    if (isset($_FILES[$polje_ime]) && $_FILES[$polje_ime]['error'] == 0 && !empty($_FILES[$polje_ime]['name'])) {
        $ime = basename($_FILES[$polje_ime]['name']);
        $tmp = $_FILES[$polje_ime]['tmp_name'];
        
        if (in_array(strtolower(pathinfo($ime, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']) && 
            getimagesize($tmp) && 
            move_uploaded_file($tmp, "datoteke/" . $ime)) {
            return $ime;
        }
    }
    return $privzeta_slika;
}

function preveri_prijavo($sporocilo = "Za to operacijo se morate prijaviti.") {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['idu'])) {
        die("<p class='obvestilo-napaka'>$sporocilo <a href='prijava.php'>Prijava</a></p>");
    }
}

function pridobi_profilno_sliko($slika_iz_baze) {
    if (!empty($slika_iz_baze)) {
        return $slika_iz_baze;
    }
    return 'default_prof.png';
}

function pridobi_povprecno_oceno($link, $knjiga_id) {
    $sql = "SELECT AVG(ocena) AS povprecje FROM ocene WHERE knjiga_id = $knjiga_id;";
    $rez = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($rez);
    
    if ($row['povprecje'] !== null) {
        return number_format($row['povprecje'], 1) . " / 5";
    }
    return "Brez ocen";
}

?>