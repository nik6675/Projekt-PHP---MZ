<?php
include 'baza.php';
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Registracija - Evidenca Knjig</title>
    <link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body class="stran-avtentikacije">
    <div class="avtentikacija-kontejner">
        <h1 class="avtentikacija-naslov">Registracija</h1>
        
        <form action="registracija_vnos.php" method="post" class="avtentikacija-obrazec">
            <div class="obrazec-skupina">
                <input type="text" name="ime" placeholder="Vnesi ime" required class="obrazec-vnos" />
            </div>
            <div class="obrazec-skupina">
                <input type="text" name="priimek" placeholder="Vnesi priimek" required class="obrazec-vnos" />
            </div>
            <div class="obrazec-skupina">
                <input type="text" name="uporabnisko_ime" placeholder="Vnesi uporabniško ime" required class="obrazec-vnos" />
            </div>
            <div class="obrazec-skupina">
                <input type="email" name="email" placeholder="Vnesi email" required class="obrazec-vnos" />
            </div>
            <div class="obrazec-skupina">
                <input type="password" name="geslo" placeholder="Vnesi geslo" required class="obrazec-vnos" />
            </div>
            <input type="submit" value="Registriraj se" class="avtentikacija-gumb" />
        </form>

        <p class="avtentikacija-povezava"> Že imate račun? <a href="prijava.php"> Prijavite se! </a> </p>
    </div>
</body>
</html>