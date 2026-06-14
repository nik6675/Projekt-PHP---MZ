<?php
require_once 'baza.php';
include 'glava.php';

preveri_prijavo("Za ogled svojega seznama se morate najprej prijaviti.");

$uporabnik_id = (int)$_SESSION['idu'];

$sql = "SELECT uk.knjiga_id, uk.status, uk.ustvarjeno, 
               k.naslov, k.slika, k.leto_izdaje,
               a.ime, a.priimek
        FROM uporabnik_knjige uk
        INNER JOIN knjige k ON uk.knjiga_id = k.id
        INNER JOIN knjige_avtorji ka ON k.id = ka.knjiga_id
        INNER JOIN avtorji a ON ka.avtor_id = a.id
        WHERE uk.uporabnik_id = $uporabnik_id
        ORDER BY uk.ustvarjeno DESC";

$result = mysqli_query($link, $sql);
?>

<div class="naslov-strani-blok">
    <h2>Moj osebni seznam knjig</h2>
</div>

<div class="seznam-kontejner">
    <?php 
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) { 
            
            if ($row['status'] == 'prebrano') {
                $status_izpis = 'Prebrano';
            } 
			elseif ($row['status'] == 'berem') {
                $status_izpis = 'Berem';
            }
			else {
                $status_izpis = 'Želim prebrati';
            }

        ?>
            <div class="kartica">
                <div class="kartica-slika">
                    <img src="datoteke/<?php echo htmlspecialchars($row['slika']); ?>" alt="Naslovnica">
                </div>
                
                <div class="kartica-vsebina">
                    <h3><?php echo htmlspecialchars($row['naslov']); ?></h3>
                    <p><strong>Avtor:</strong> <?php echo htmlspecialchars($row['ime'] . " " . $row['priimek']); ?></p>
                    <p><strong>Status:</strong> <span class="znackka-status"><?php echo $status_izpis; ?></span></p>
                    <p class="kartica-datum">Posodobljeno: <?php echo $row['ustvarjeno']; ?></p>
                </div>
                
                <div class="kartica-gumbi">
                    <a href="dodaj_na_seznam.php?id=<?php echo $row['knjiga_id']; ?>" class="gumb gumb-glavni">Spremeni status</a>
                    <a href="odstrani_iz_seznama.php?id=<?php echo $row['knjiga_id']; ?>" class="gumb gumb-izbrisi" onclick="return confirm('Res želiš odstraniti to knjigo s svojega seznama?');">Odstrani</a>
                </div>
            </div>
        <?php 
        }
    } else {
        echo "<p>Vaš seznam je še prazen. Dodajte kakšno knjigo s seznama knjig!</p>";
    }
    ?>
</div>

<?php
include 'noga.php';
?>