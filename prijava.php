<?php
include 'baza.php';
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Prijava - Evidenca Knjig</title>
    <link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body class="stran-avtentikacije">

    <div class="avtentikacija-kontejner">
        <h1 class="avtentikacija-naslov">Prijava</h1>

        <form action="prijava_preveri.php" method="post" class="avtentikacija-obrazec">
            <div class="obrazec-skupina">
                <input type="text" name="uporabnisko_ime" placeholder="Vnesi uporabniško ime" required class="obrazec-vnos" />
            </div>
            <div class="obrazec-skupina">
                <input type="password" name="geslo" placeholder="Vnesi geslo" required class="obrazec-vnos" />
            </div>
            <input type="submit" value="Prijavi se" class="avtentikacija-gumb" />
        </form>

        <p class="avtentikacija-povezava"> Še nimate računa? <a href="registracija.php"> Registrirajte se! </a> </p>
    </div>

</body>
</html>