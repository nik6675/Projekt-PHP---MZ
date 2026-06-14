<?php
require_once 'baza.php';
include 'glava.php';

preveri_prijavo("Za dodajanje knjig na seznam se morate najprej prijaviti.");

$knjiga_id = (int)$_GET['id'];
$sql = "SELECT * FROM knjige WHERE id = $knjiga_id";
$resultat = mysqli_query($link, $sql);
$knjiga = mysqli_fetch_array($resultat);
?>

<div class="okvir-obrazca">
    <h2>Dodaj knjigo na moj osebni seznam</h2>
    <p>Izbiraš status za knjigo: <b><?php echo htmlspecialchars($knjiga['naslov']); ?></b></p>

    <form action="dodaj_na_seznam_baza.php" method="post">
        <input type="hidden" name="knjiga_id" value="<?php echo $knjiga_id; ?>" />
        
        <div class="skupina-polja">
            <label for="status">Tvoj trenutni status za to knjigo:</label>
            <select name="status" id="status" required class="vnosno-polje">
                <option value="zelim_prebrati">Želim prebrati</option>
                <option value="berem">Berem</option>
                <option value="prebrano">Prebrano</option>
            </select>
        </div>
        
        <input type="submit" value="Shrani na seznam" class="gumb gumb-glavni" />
    </form>
</div>

<?php include 'noga.php'; ?>