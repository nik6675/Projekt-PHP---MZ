<?php
require_once 'baza.php';
include 'glava.php';

$sql = "SELECT k.id, k.naslov, k.leto_izdaje, k.slika, k.opis, 
               a.ime, a.priimek, 
               z.naziv_zanra 
        FROM knjige k
        INNER JOIN knjige_avtorji ka ON k.id = ka.knjiga_id
        INNER JOIN avtorji a ON ka.avtor_id = a.id
        INNER JOIN knjige_zanri kz ON k.id = kz.knjiga_id
        INNER JOIN zanri z ON kz.zanr_id = z.id;";

$result = mysqli_query($link, $sql);
?>

<div class="naslov-strani-blok">
    <h2>Seznam knjig</h2>
    <?php if (isset($_SESSION['idu'])) { ?>
        <a href="vnos_knjiga.php" class="gumb gumb-glavni">+ Dodaj knjigo</a>
    <?php } ?>
</div>

<div class="seznam-kontejner">
    <?php while ($row = mysqli_fetch_array($result)) { ?>
        <div class="kartica">
            <div class="kartica-slika">
                <img src="datoteke/<?php echo htmlspecialchars($row['slika']); ?>" alt="Naslovnica">
            </div>
            
            <div class="kartica-vsebina">
                <h3><?php echo htmlspecialchars($row['naslov']); ?></h3>
                <p><strong>Avtor:</strong> <?php echo htmlspecialchars($row['ime'] . " " . $row['priimek']); ?></p>
                <p><strong>Žanr:</strong> <?php echo htmlspecialchars($row['naziv_zanra']); ?> | <strong>Leto:</strong> <?php echo htmlspecialchars($row['leto_izdaje']); ?></p>
                <p class="kartica-opis"><?php echo htmlspecialchars($row['opis']); ?></p>
            </div>
            
            <div class="kartica-gumbi">
                <a href="ocene.php?id=<?php echo $row['id']; ?>" class="gumb gumb-glavni">Ocene knjige</a>
                <?php if (isset($_SESSION['idu'])) { ?>
                    <a href="dodaj_na_seznam.php?id=<?php echo $row['id']; ?>" class="gumb gumb-stranski">Shrani knjigo</a> 
                <?php } ?>
                
                <?php if (isset($_SESSION['vloga_id']) && $_SESSION['vloga_id'] == 1) { ?>
                    <div class="admin-gumbi">
                        <a href="update_knjiga.php?id=<?php echo $row['id']; ?>" class="gumb gumb-uredi">Uredi</a>
                        <a href="izbris_knjiga.php?id=<?php echo $row['id']; ?>" class="gumb gumb-izbrisi" onclick="return confirm('Res želiš izbrisati knjigo?');">Izbriši</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php
include 'noga.php';
?>