<?php
require_once 'baza.php';
include 'glava.php';
?>

<div class="okvir-obrazca">
    <h2>Dodaj novega avtorja</h2>

    <form action="vnos_avtor_baza.php" method="post" enctype="multipart/form-data">
        <div class="skupina-polja">
            <label>Ime avtorja:</label>
            <input type="text" name="ime" required class="vnosno-polje">
        </div>
        
        <div class="skupina-polja">
            <label>Priimek avtorja:</label>
            <input type="text" name="priimek" required class="vnosno-polje">
        </div>
        
        <div class="skupina-polja">
            <label>Leto rojstva:</label>
            <input type="number" name="leto_rojstva" required class="vnosno-polje">
        </div>
        
        <div class="skupina-polja">
            <label>Država:</label>
            <input type="text" name="drzava" required class="vnosno-polje">
        </div>

        <div class="skupina-polja">
            <label>Portret avtorja (slika):</label>
            <input type="file" name="slika" class="vnosno-polje">
        </div>

        <input type="submit" value="Dodaj avtorja" class="gumb gumb-glavni">
    </form>
</div>

<?php include 'noga.php'; ?>