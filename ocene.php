<?php
require_once 'baza.php'; 
include 'glava.php'; 

if (!isset($_GET['id'])) { 
    echo "<p class='obvestilo-napaka'>Knjiga ni izbrana.</p>"; 
    include 'noga.php'; 
    exit(); 
} 

$knjiga_id = (int)$_GET['id']; 

$sql_knjiga = "SELECT naslov FROM knjige WHERE id = $knjiga_id;"; 
$res_knjiga = mysqli_query($link, $sql_knjiga); 
$knjiga = mysqli_fetch_array($res_knjiga); 

if (!$knjiga) { 
    echo "<p class='obvestilo-napaka'>Knjiga ne obstaja.</p>"; 
    include 'noga.php'; 
    exit(); 
} 

$x = pridobi_povprecno_oceno($link, $knjiga_id);
?>

<div class="ocene-glava-kontejner">
    <h2 class="ocene-naslov">Ocene za knjigo: <?php echo htmlspecialchars($knjiga['naslov']); ?> (<?php echo $x; ?>)</h2> 
    <div class="ocene-nazaj">
        <a href="seznam_knjig.php" class="gumb-nazaj">Nazaj na seznam knjig</a>
    </div> 
    <div class="clear-fix"></div>
</div>

<div class="ocene-vsebina">
    <h3 class="ocene-podnaslov">Mnenja uporabnikov</h3> 
    <div class="seznam-ocen"> 
        <?php 
        $sql_ocene = "SELECT o.id, o.uporabnik_id, o.ocena, o.mnenje, o.ustvarjeno, u.uporabnisko_ime, u.slika 
                      FROM ocene o
                      INNER JOIN uporabniki u ON o.uporabnik_id = u.id
                      WHERE o.knjiga_id = $knjiga_id
                      ORDER BY o.ustvarjeno DESC;"; 
        
        $ocene_rezultat = mysqli_query($link, $sql_ocene); 

        if (mysqli_num_rows($ocene_rezultat) > 0) { 
            while ($row = mysqli_fetch_array($ocene_rezultat)) { 
                
                if (!empty($row['slika'])) { 
                    $slika_komentarja = $row['slika']; 
                } else { 
                    $slika_komentarja = 'default_prof.png'; 
                } 
                ?>
                <div class="ocena-kartica">
                    <div class="ocena-kartica-glava">
                        <h4 class="ocena-avtor">
                            <img src="datoteke/<?php echo $slika_komentarja; ?>" alt="Profil" class="ocena-profil-slika"> 
                            Uporabnik: <?php echo htmlspecialchars($row['uporabnisko_ime']); ?> 
                        </h4>
                        <div class="ocena-zvezdice">Ocena: <?php echo $row['ocena']; ?> / 5</div> 
                    </div>
                    
                    <p class="ocena-komentar"><?php echo nl2br(htmlspecialchars($row['mnenje'])); ?></p> 
                    
                    <div class="ocena-podnozje">
                        <p class="ocena-datum">Objavljeno: <?php echo $row['ustvarjeno']; ?></p> 
                        
                        <?php 
                        $je_avtor = (isset($_SESSION['idu']) && $_SESSION['idu'] == $row['uporabnik_id']); 
                        $je_admin = (isset($_SESSION['vloga_id']) && $_SESSION['vloga_id'] == 1); 

                        if ($je_avtor || $je_admin) { 
                        ?>
                            <div class="ocena-akcije">
                                <?php if ($je_avtor) { ?>
                                    <a href="ocena_uredi.php?id=<?php echo $row['id']; ?>" class="povezava-uredi">Uredi</a>
                                <?php } ?>
                                <a href="ocena_brisi.php?id=<?php echo $row['id']; ?>&knjiga_id=<?php echo $knjiga_id; ?>" class="povezava-izbrisi" onclick="return confirm('Ali ste prepričani, da želite izbrisati to oceno?');">Izbriši</a>
                            </div>
                        <?php } ?>
                        <div class="clear-fix"></div>
                    </div> 
                </div> 
                <?php 
            } 
        } else { 
            echo "<p class='obvestilo-prijava'>Ta knjiga še nima nobene ocene. Bodite prvi!</p>"; 
        } 
        ?> 
    </div> 

    <div class="dodaj-oceno-blok">
        <h3 class="ocene-podnaslov">Dodaj svojo oceno</h3> 
        <?php 
        $je_ze_ocenil = false;
        if (isset($_SESSION['idu'])) {
            $trenutni_uporabnik = $_SESSION['idu'];
            $sql_preveri = "SELECT id FROM ocene WHERE uporabnik_id = $trenutni_uporabnik AND knjiga_id = $knjiga_id;";
            $res_preveri = mysqli_query($link, $sql_preveri);
            
            if (mysqli_num_rows($res_preveri) > 0) {
                $je_ze_ocenil = true;
            }
        }

        if (isset($_SESSION['idu'])) { 
            if ($je_ze_ocenil) {
                echo "<p class='obvestilo-uspeh'>To knjigo ste že ocenili. Vsak uporabnik lahko odda le eno oceno. Svojo trenutno oceno lahko popravite ali izbrišete zgoraj.</p>";
            } else {
            ?> 
            <form action="vnos_ocene_baza.php" method="post" class="obrazec-ocena"> 
                <input type="hidden" name="knjiga_id" value="<?php echo $knjiga_id; ?>"> 
                <div class="obrazec-skupina">
                    <label class="obrazec-oznaka">Vaša ocena:</label>
                    <select name="ocena" required class="obrazec-vnos"> 
                        <option value="5">5 - Odlično</option> 
                        <option value="4">4 - Zelo dobro</option> 
                        <option value="3">3 - Dobro</option> 
                        <option value="2">2 - Slabo</option> 
                        <option value="1">1 - Zelo slabo</option> 
                    </select> 
                </div>
                <div class="obrazec-skupina">
                    <label class="obrazec-oznaka">Vaše mnenje:</label>
                    <textarea name="mnenje" rows="5" cols="40" placeholder="Zapišite svoje misli o knjigi..." required class="obrazec-vnos tekstovno-polje"></textarea> 
                </div>
                <input type="submit" value="Oddaj oceno" class="obrazec-gumb"> 
            </form> 
            <?php 
            }
        } else { 
        ?> 
            <p class="obvestilo-prijava">Za oddajo ocene ali komentarja se morate <a href="prijava.php" class="povezava_glava" style="margin-left:0; font-weight:bold; color:#3b5998;">prijaviti</a>.</p> 
        <?php 
        } 
        ?> 
    </div>
</div>
<?php 
include 'noga.php'; 
?>