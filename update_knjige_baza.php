<?php
require_once 'baza.php';
preveri_admina();

$id = (int)$_POST['id'];
$naslov = $_POST['naslov'];
$leto = (int)$_POST['leto_izdaje'];
$opis = $_POST['opis'];
$avtor_id = (int)$_POST['avtor_id'];
$zanr_id = (int)$_POST['zanr_id'];

$ime_slike = nalozi_sliko('slika', null);

if ($ime_slike !== null) {
    $sql = "UPDATE knjige SET naslov=?, leto_izdaje=?, opis=?, slika=? WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sissi", $naslov, $leto, $opis, $ime_slike, $id);
} else {
    $sql = "UPDATE knjige SET naslov=?, leto_izdaje=?, opis=? WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sisi", $naslov, $leto, $opis, $id);
}
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$del_avtor = mysqli_prepare($link, "DELETE FROM knjige_avtorji WHERE knjiga_id = ?");
mysqli_stmt_bind_param($del_avtor, "i", $id);
mysqli_stmt_execute($del_avtor);
mysqli_stmt_close($del_avtor);

$ins_avtor = mysqli_prepare($link, "INSERT INTO knjige_avtorji (knjiga_id, avtor_id) VALUES (?, ?)");
mysqli_stmt_bind_param($ins_avtor, "ii", $id, $avtor_id);
mysqli_stmt_execute($ins_avtor);
mysqli_stmt_close($ins_avtor);

$del_zanr = mysqli_prepare($link, "DELETE FROM knjige_zanri WHERE knjiga_id = ?");
mysqli_stmt_bind_param($del_zanr, "i", $id);
mysqli_stmt_execute($del_zanr);
mysqli_stmt_close($del_zanr);

$ins_zanr = mysqli_prepare($link, "INSERT INTO knjige_zanri (knjiga_id, zanr_id) VALUES (?, ?)");
mysqli_stmt_bind_param($ins_zanr, "ii", $id, $zanr_id);
mysqli_stmt_execute($ins_zanr);
mysqli_stmt_close($ins_zanr);

header("Location: seznam_knjig.php");
?>