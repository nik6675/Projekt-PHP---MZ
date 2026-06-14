<?php
include 'baza.php';
include 'glava.php';

preveri_prijavo("Za urejanje profila se morate prijaviti.");

$id_uporabnika = (int)$_SESSION['idu']; 

$sql = "SELECT * FROM uporabniki WHERE id = '$id_uporabnika'"; 
$rezultat = mysqli_query($link, $sql); 
$uporabnik = mysqli_fetch_array($rezultat); 

$trenutna_slika = pridobi_profilno_sliko($uporabnik['slika']);
?>

<div class="profil-kontejner">
    <h1 class="profil-naslov">Uredi svoj profil</h1>

    <div class="profil-info-blok">
        <p class="profil-oznaka">Trenutna profilna slika:</p>
        <img src="datoteke/<?php echo $trenutna_slika; ?>" alt="Trenutna profilna slika" class="profil-slika-predogled">
    </div>

    <form action="profil_baza.php" method="post" enctype="multipart/form-data" class="profil-obrazec"> 
        <div class="obrazec-skupina">
            <label class="obrazec-oznaka">Uporabniško ime:</label>
            <input type="text" name="uporabnisko_ime" value="<?php echo htmlspecialchars($uporabnik['uporabnisko_ime']); ?>" required class="obrazec-vnos" />
        </div>
        
        <div class="obrazec-skupina">
            <label class="obrazec-oznaka">Ime:</label>
            <input type="text" name="ime" value="<?php echo htmlspecialchars($uporabnik['ime']); ?>" required class="obrazec-vnos" />
        </div>
        
        <div class="obrazec-skupina">
            <label class="obrazec-oznaka">Priimek:</label>
            <input type="text" name="priimek" value="<?php echo htmlspecialchars($uporabnik['priimek']); ?>" required class="obrazec-vnos" />
        </div>
        
        <div class="obrazec-skupina">
            <label class="obrazec-oznaka">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($uporabnik['email']); ?>" required class="obrazec-vnos" />
        </div>
        
        <div class="obrazec-skupina">
            <label class="obrazec-oznaka">Novo geslo (pusti prazno, če ga ne želiš spremeniti):</label>
            <input type="password" name="novo_geslo" placeholder="Vnesi novo geslo" class="obrazec-vnos" />
        </div>
        
        <div class="obrazec-skupina">
            <label class="obrazec-oznaka">Zamenjaj profilno sliko:</label>
            <input type="file" name="slika" accept="image/*" class="obrazec-vnos-datoteka" />
        </div>
        
        <input type="submit" value="Shrani spremembe" class="obrazec-gumb" /> 
    </form> 
</div>
<?php
include 'noga.php'; 
?>