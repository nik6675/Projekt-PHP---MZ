<?php
require_once 'baza.php';
include 'glava.php';

$avtorji = mysqli_query($link, "SELECT * FROM avtorji");
$zanri = mysqli_query($link, "SELECT * FROM zanri");
?>

<div class="okvir-obrazca">
    <h2>Dodaj novo knjigo</h2>

    <form action="vnos_knjige_baza.php" method="post" enctype="multipart/form-data"> 
        <div class="skupina-polja">
            <label>Naslov knjige:</label>
            <input type="text" name="naslov" required class="vnosno-polje">
        </div>
        
        <div class="skupina-polja">
            <label>Leto izdaje:</label>
            <input type="number" name="leto_izdaje" required class="vnosno-polje">
        </div>
        
        <div class="skupina-polja">
            <label>Opis / Obnova:</label>
            <textarea name="opis" rows="5" class="vnosno-polje"></textarea>
        </div>
        
        <div class="skupina-polja">
            <label>Avtor:</label>
            <select name="avtor_id" class="vnosno-polje">
                <?php while($a = mysqli_fetch_array($avtorji)) { ?>
                    <option value="<?php echo $a['id']; ?>"><?php echo htmlspecialchars($a['ime']." ".$a['priimek']); ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="skupina-polja">
            <label>Žanr:</label>
            <select name="zanr_id" class="vnosno-polje">
                <?php while($z = mysqli_fetch_array($zanri)) { ?>
                    <option value="<?php echo $z['id']; ?>"><?php echo htmlspecialchars($z['naziv_zanra']); ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="skupina-polja">
            <label>Naslovnica knjige (slika):</label>
            <input type="file" name="slika" class="vnosno-polje">
        </div>

        <input type="submit" value="Dodaj knjigo" class="gumb gumb-glavni">
    </form>
</div>

<?php include 'noga.php'; ?>