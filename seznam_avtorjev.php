<?php
require_once 'baza.php';
include 'glava.php';

$sql = "SELECT id, ime, priimek, leto_rojstva, drzava, slika FROM avtorji;";
$result = mysqli_query($link, $sql);
?>

<div class="naslov-strani-blok">
    <h2>Seznam avtorjev</h2>
    <?php if (isset($_SESSION['idu'])) { ?>
        <a href="vnos_avtor.php" class="gumb gumb-glavni">+ Dodaj avtorja</a>
    <?php } ?>
</div>

<div class="seznam-kontejner">
    <?php while ($row = mysqli_fetch_array($result)) { ?>
        <div class="kartica">
            <div class="kartica-slika">
                <img src="datoteke/<?php echo htmlspecialchars($row['slika']); ?>" alt="Portret avtorja">
            </div>
            
            <div class="kartica-vsebina">
                <h3><a href="knjige_avtorja.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['ime'] . " " . $row['priimek']); ?></a></h3>
                <p><strong>Rojen(a):</strong> <?php echo htmlspecialchars($row['leto_rojstva']); ?> | <strong>Država:</strong> <?php echo htmlspecialchars($row['drzava']); ?></p>
            </div>
            
            <div class="kartica-gumbi">
                <a href="knjige_avtorja.php?id=<?php echo $row['id']; ?>" class="gumb gumb-glavni">Knjige avtorja</a>
                
                <?php if (isset($_SESSION['vloga_id']) && $_SESSION['vloga_id'] == 1) { ?>
                    <div class="admin-gumbi">
                        <a href="update_avtor.php?id=<?php echo $row['id']; ?>" class="gumb gumb-uredi">Uredi</a>
                        <a href="izbris_avtor.php?id=<?php echo $row['id']; ?>" class="gumb gumb-izbrisi" onclick="return confirm('Res želiš izbrisati avtorja?');">Izbriši</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php
include 'noga.php';
?>