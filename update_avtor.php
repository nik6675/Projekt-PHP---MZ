<?php
require_once 'baza.php';
preveri_admina();
include 'glava.php';

$avtor_id = (int)$_GET['id'];
$resultat = mysqli_query($link, "SELECT * FROM avtorji WHERE id = $avtor_id");
$avtor = mysqli_fetch_array($resultat);
?>

<div class="okvir-obrazca">
    <h2>Uredi podatke za avtorja</h2>
    
    <form action="update_avtorja_baza.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $avtor_id; ?>" />
        
        <div class="skupina-polja">
            <label>Ime:</label>
            <input type="text" name="ime" value="<?php echo htmlspecialchars($avtor['ime']); ?>" required class="vnosno-polje" />
        </div>
        
        <div class="skupina-polja">
            <label>Priimek:</label>
            <input type="text" name="priimek" value="<?php echo htmlspecialchars($avtor['priimek']); ?>" required class="vnosno-polje" />
        </div>
        
        <div class="skupina-polja">
            <label>Leto rojstva:</label>
            <input type="number" name="leto_rojstva" value="<?php echo $avtor['leto_rojstva']; ?>" required class="vnosno-polje" />
        </div>
        
        <div class="skupina-polja">
            <label>Država:</label>
            <input type="text" name="drzava" value="<?php echo htmlspecialchars($avtor['drzava']); ?>" required class="vnosno-polje" />
        </div>
        
        <div class="skupina-polja">
            <label>Zamenjaj portret avtorja (neobvezno):</label>
            <input type="file" name="slika" class="vnosno-polje" />
        </div>
        
        <input type="submit" value="Shrani spremembe" class="gumb gumb-glavni" />
    </form>
</div>

<?php include 'noga.php'; ?>