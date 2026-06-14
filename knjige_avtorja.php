<?php
require_once 'baza.php';
include 'glava.php';

$avtor_id = (int)$_GET['id'];

$avtor_sql = "SELECT * FROM avtorji WHERE id = $avtor_id";
$avtor_result = mysqli_query($link, $avtor_sql);
$avtor = mysqli_fetch_array($avtor_result);

$knjige_sql = "SELECT k.*, z.naziv_zanra 
               FROM knjige k
               INNER JOIN knjige_avtorji ka ON k.id = ka.knjiga_id
               INNER JOIN knjige_zanri kz ON k.id = kz.knjiga_id
               INNER JOIN zanri z ON kz.zanr_id = z.id
               WHERE ka.avtor_id = $avtor_id";

$knjige_result = mysqli_query($link, $knjige_sql);
?>

<div class="naslov-strani-blok">
    <h2>Knjige avtorja: <?php echo htmlspecialchars($avtor['ime'] . " " . $avtor['priimek']); ?></h2>
    <p><i>Država: <?php echo htmlspecialchars($avtor['drzava']); ?> | Rojen(a): <?php echo htmlspecialchars($avtor['leto_rojstva']); ?></i></p>
</div>

<div class="seznam-kontejner">
    <?php 
    if (mysqli_num_rows($knjige_result) > 0) {
        while ($row = mysqli_fetch_array($knjige_result)) { 
        ?>
            <div class="kartica">
                <div class="kartica-slika">
                    <img src="datoteke/<?php echo htmlspecialchars($row['slika']); ?>" alt="Naslovnica">
                </div>
                
                <div class="kartica-vsebina">
                    <h3><?php echo htmlspecialchars($row['naslov']); ?></h3>
                    <p><strong>Žanr:</strong> <?php echo htmlspecialchars($row['naziv_zanra']); ?></p>
                    <p><strong>Leto izdaje:</strong> <?php echo htmlspecialchars($row['leto_izdaje']); ?></p>
                    <p class="kartica-opis"><?php echo htmlspecialchars($row['opis']); ?></p>
                </div>
                
                <div class="kartica-gumbi">
                    <a href="ocene.php?id=<?php echo $row['id']; ?>" class="gumb gumb-glavni">Ocene knjige</a>
                    <?php if (isset($_SESSION['idu'])) { ?>
                        <a href="dodaj_na_seznam.php?id=<?php echo $row['id']; ?>" class="gumb gumb-stranski">Shrani knjigo</a>
                    <?php } ?>
                </div>
            </div>
        <?php 
        }
    } else {
        echo "<p>Ta avtor nima zabeleženih knjig.</p>";
    }
    ?>
</div>

<?php
include 'noga.php';
?>