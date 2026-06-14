<?php
require_once 'baza.php';
include 'seja.php';

preveri_prijavo();

if (!isset($_GET['id'])) {
    die("Ocena ni izbrana.");
}

$ocena_id = (int)$_GET['id'];
$trenutni_uporabnik = $_SESSION['idu'];

if (!empty($_POST)) {
    $nova_ocena = (int)$_POST['ocena'];
    $novo_mnenje = mysqli_real_escape_string($link, $_POST['mnenje']);
    $knjiga_id = (int)$_POST['knjiga_id'];

    $sql_update = "UPDATE ocene SET ocena = $nova_ocena, mnenje = '$novo_mnenje' WHERE id = $ocena_id AND uporabnik_id = $trenutni_uporabnik;";
    
    if (mysqli_query($link, $sql_update)) {
        header("Location: ocene.php?id=" . $knjiga_id);
        exit();
    } else {
        echo "Napaka pri posodabljanju: " . mysqli_error($link);
    }
}

$sql_izbira = "SELECT * FROM ocene WHERE id = $ocena_id AND uporabnik_id = $trenutni_uporabnik;";
$rezultat = mysqli_query($link, $sql_izbira);
$ocena_podatki = mysqli_fetch_array($rezultat);

if (!$ocena_podatki) {
    die("Ocena ne obstaja ali pa nimate pravic za njeno urejanje.");
}
?>

<?php
include 'glava.php';
?>

<div class="okvir_obrazca">
    <h2>Uredi svojo oceno</h2>

    <form action="ocena_uredi.php?id=<?php echo $ocena_id; ?>" method="post">
        <input type="hidden" name="knjiga_id" value="<?php echo $ocena_podatki['knjiga_id']; ?>">

        <div class="vnosna_skupina">
            <label>Vaša ocena:</label>
            <select name="ocena" required>
                <option value="5" <?php if($ocena_podatki['ocena'] == 5) echo 'selected'; ?>>5 - Odlično</option>
                <option value="4" <?php if($ocena_podatki['ocena'] == 4) echo 'selected'; ?>>4 - Zelo dobro</option>
                <option value="3" <?php if($ocena_podatki['ocena'] == 3) echo 'selected'; ?>>3 - Dobro</option>
                <option value="2" <?php if($ocena_podatki['ocena'] == 2) echo 'selected'; ?>>2 - Slabo</option>
                <option value="1" <?php if($ocena_podatki['ocena'] == 1) echo 'selected'; ?>>1 - Zelo slabo</option>
            </select>
        </div>

        <div class="vnosna_skupina">
            <label>Vaše mnenje:</label>
            <textarea name="mnenje" rows="5" class="tekstovno-polje" required><?php echo htmlspecialchars($ocena_podatki['mnenje']); ?></textarea>
        </div>

        <input type="submit" value="Shrani spremembe" class="gumb_oddaj">
        <a href="ocene.php?id=<?php echo $ocena_podatki['knjiga_id']; ?>" class="gumb-prekliči">Prekliči</a>
    </form>
</div>

<?php
include 'noga.php';
?>