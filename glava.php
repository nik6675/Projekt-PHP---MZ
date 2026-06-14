<?php
require_once 'seja.php';
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Evidenca Knjig</title>
    <link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body>

<div class="okvir_strani">

    <div class="meni_glava">
        
        <div class="levi_del_glava">
            <a href="index.php" class="logo_glava">Evidenca Prebranih Knjig</a>
        </div>
        
        <div class="desni_del_glava">
            <a href="index.php" class="povezava_glava">Home</a>
            <a href="seznam_avtorjev.php" class="povezava_glava">Avtorji</a>
            <a href="seznam_knjig.php" class="povezava_glava">Knjige</a>
            
            <?php if(isset($_SESSION['idu'])) { ?>
                <a href="seznam_mojih.php" class="povezava_glava">Moj seznam</a>
                
                <?php if($_SESSION['vloga_id'] == 1) { ?>
                    <a href="admin_panel.php" class="admin_gumb_glava">Nadzorna plošča</a>
                <?php } ?>
                
                <a href="profil.php" class="uporabnik_glava">
    <?php echo htmlspecialchars($_SESSION['uporabnisko_ime']); ?>

			<?php 
				$profilna_slika = 'default_prof.png';
					if (isset($_SESSION['slika']) && !empty($_SESSION['slika'])) {
						$profilna_slika = $_SESSION['slika'];
					}	
			?>
    
				<img src="datoteke/<?php echo htmlspecialchars($profilna_slika); ?>" alt="Profil" class="slika_uporabnika_glava">
				</a>
                
                <a href="odjava.php" class="odjava_gumb_glava">(Odjava)</a>
            <?php } else { ?>
                <a href="prijava.php" class="povezava_glava">Prijava</a>
                <a href="registracija.php" class="povezava_glava">Registracija</a>
            <?php } ?>
        </div>
        
        <div class="clear-fix"></div>
        
    </div>

    <div class="vsebina_strani">