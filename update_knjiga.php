<?php
require_once 'baza.php';
preveri_admina(); 

$knjiga_id = (int)$_GET['id'];

$knjiga_rez = mysqli_query($link, "SELECT * FROM knjige WHERE id = $knjiga_id");
$knjiga = mysqli_fetch_array($knjiga_rez);

$trenutni_avtor_rez = mysqli_query($link, "SELECT avtor_id FROM knjige_avtorji WHERE knjiga_id = $knjiga_id");
$trenutni_avtor = mysqli_fetch_array($trenutni_avtor_rez);

if ($trenutni_avtor) {
    $trenutni_avtor_id = $trenutni_avtor['avtor_id'];
} else {
    $trenutni_avtor_id = 0;
}

$trenutni_zanr_rez = mysqli_query($link, "SELECT zanr_id FROM knjige_zanri WHERE knjiga_id = $knjiga_id");
$trenutni_zanr = mysqli_fetch_array($trenutni_zanr_rez);

if ($trenutni_zanr) {
    $trenutni_zanr_id = $trenutni_zanr['zanr_id'];
} else {
    $trenutni_zanr_id = 0;
}

$avtorji = mysqli_query($link, "SELECT * FROM avtorji");
$zanri = mysqli_query($link, "SELECT * FROM zanri");

include 'glava.php';
?>

<div class="okvir_obrazca">
    <h2>Uredi podatke o knjigi</h2>

    <form action="update_knjige_baza.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $knjiga_id; ?>" />
        
        <div class="vnosna_skupina">
            <label>Naslov:</label>
            <input type="text" name="naslov" value="<?php echo htmlspecialchars($knjiga['naslov']); ?>" required />
        </div>
        
        <div class="vnosna_skupina">
            <label>Leto izdaje:</label>
            <input type="number" name="leto_izdaje" value="<?php echo $knjiga['leto_izdaje']; ?>" required />
        </div>
        
        <div class="vnosna_skupina">
            <label>Opis:</label>
            <textarea name="opis" rows="5" required><?php echo htmlspecialchars($knjiga['opis']); ?></textarea>
        </div>
        
        <div class="vnosna_skupina">
            <label>Avtor:</label>
            <select name="avtor_id">
                <?php while($a = mysqli_fetch_array($avtorji)) { ?>
                    <option value="<?php echo $a['id']; ?>" <?php if($a['id'] == $trenutni_avtor_id) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($a['ime']." ".$a['priimek']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="vnosna_skupina">
            <label>Žanr:</label>
            <select name="zanr_id">
                <?php while($z = mysqli_fetch_array($zanri)) { ?>
                    <option value="<?php echo $z['id']; ?>" <?php if($z['id'] == $trenutni_zanr_id) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($z['naziv_zanra']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="vnosna_skupina">
            <label>Zamenjaj naslovnico (neobvezno):</label>
            <input type="file" name="slika" />
        </div>

        <input type="submit" value="Shrani spremembe" class="gumb_oddaj" />
    </form>
</div>

<?php include 'noga.php'; ?>