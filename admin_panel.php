<?php
include 'baza.php';
preveri_admina(); 
include 'glava.php';

if (isset($_GET['akcija']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $akcija = $_GET['akcija'];

    if ($akcija == 'izbrisi') {
        mysqli_query($link, "DELETE FROM ocene WHERE uporabnik_id = $id");
        mysqli_query($link, "DELETE FROM uporabniki WHERE id = $id");
    }

    if ($akcija == 'admin') {
        mysqli_query($link, "UPDATE uporabniki SET vloga_id = 1 WHERE id = $id");
    }

    if ($akcija == 'uporabnik') {
        mysqli_query($link, "UPDATE uporabniki SET vloga_id = 2 WHERE id = $id");
    }

    header("Location: admin_panel.php");
    exit();
}

$sql = "SELECT * FROM uporabniki";
$rezultat = mysqli_query($link, $sql);
?>

<div class="admin-kontejner">
    <h1 class="admin-naslov">Nadzorna plošča za Admina</h1>

    <div class="tabela-responzivna">
        <table class="admin-tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Uporabniško ime</th>
                    <th>Ime in Priimek</th>
                    <th>Email</th>
                    <th>Trenutna vloga</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($rezultat)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['uporabnisko_ime']); ?></td>
						<td><?php echo htmlspecialchars($row['ime']) . " " . htmlspecialchars($row['priimek']); ?></td>
						<td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td>
						<?php
							$vloga_razred = 'vloga-uporabnik';
							$vloga_tekst = 'Navaden uporabnik';
    
							if ($row['vloga_id'] == 1) {
								$vloga_razred = 'vloga-admin';
								$vloga_tekst = 'Admin';
							}
						?>
						<span class="vloga-znacka <?php echo htmlspecialchars($vloga_razred); ?>">
						<?php echo htmlspecialchars($vloga_tekst); ?>
						</span>
					</td>
                        <td class="admin-akcije-celica">
                            <?php if ($row['vloga_id'] == 2) { ?>
                                <a href="admin_panel.php?akcija=admin&id=<?php echo $row['id']; ?>" class="gumb-akcija gumb-promoviraj">Promoviraj v Admina</a>
                            <?php } else { ?>
                                <a href="admin_panel.php?akcija=uporabnik&id=<?php echo $row['id']; ?>" class="gumb-akcija gumb-degradiraj">Spremeni v Uporabnika</a>
                            <?php } ?>

                            <span class="locilnik">|</span> 

                            <a href="admin_panel.php?akcija=izbrisi&id=<?php echo $row['id']; ?>" class="gumb-akcija gumb-izbrisi" onclick="return confirm('Ali res želiš izbrisati tega uporabnika?')">Izbriši račun</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'noga.php';
?>