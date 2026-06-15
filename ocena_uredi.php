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
    $novo_mnenje = $_POST['mnenje'];
    $knjiga_id = (int)$_POST['knjiga_id'];

    $sql_update = "UPDATE ocene SET ocena = ?, mnenje = ? WHERE id = ? AND uporabnik_id = ?;";
    
    if ($stmt = mysqli_prepare($link, $sql_update)) {
		
        mysqli_stmt_bind_param($stmt, "isii", $nova_ocena, $novo_mnenje, $ocena_id, $trenutni_uporabnik);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: ocene.php?id=" . $knjiga_id);
            exit();
        } else {
            echo "Napaka pri posodabljanju: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Napaka pri pripravi poizvedbe: " . mysqli_error($link);
    }
}

$sql_izbira = "SELECT * FROM ocene WHERE id = ? AND uporabnik_id = ?;";
$ocena_podatki = null;

if ($stmt_select = mysqli_prepare($link, $sql_izbira)) {
    mysqli_stmt_bind_param($stmt_select, "ii", $ocena_id, $trenutni_uporabnik);
    mysqli_stmt_execute($stmt_select);
    
    $rezultat = mysqli_stmt_get_result($stmt_select);
    $ocena_podatki = mysqli_fetch_array($rezultat);
    
    mysqli_stmt_close($stmt_select);
}

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
