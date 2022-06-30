<ul id="reportInfo">
	<li class="title">Sudarytų užsakymų ataskaita</li>
	<li>Sudarymo data: <span><?php echo date("Y-m-d"); ?></span></li>
	<li>Užsakymų sudarymo laikotarpis:
		<span>
		<?php
			if(!empty($data['dataNuo'])) {
				if(!empty($data['dataIki'])) {
					echo "nuo {$data['dataNuo']} iki {$data['dataIki']}";
				} else {
					echo "nuo {$data['dataNuo']}";
				}
			} else {
				if(!empty($data['dataIki'])) {
					echo "iki {$data['dataIki']}";
				} else {
					echo "nenurodyta";
				}
			}
		?>
		</span>
	</li>
    <li>Maksimali įvykdyta užsakymo kaina:
        <span>
		<?php
        if(!empty($data['uzsakymu-verte'])) {
            echo " {$data['uzsakymu-verte']} eurų";
        } else {
            echo "nenurodyta";
        }
        ?>
		</span>
    </li>
    <li>Atsiemimo tipas:
        <span>
		<?php
        if(!empty($data['paslaugu-verte'])) {
            echo " {$data['paslaugu-verte']}";
        } else {
            echo "nenurodyta";
        }
        ?>
		</span>
    </li>
</ul>
<?php
	if(sizeof($contractData) > 0) { ?>
		<table class="table">
			<thead>
				<tr>
					<th>Užsakymas</th>
					<th>Data</th>
					<th>Sudarytų užsakymų vertė</th>
					<th>Užsakyta paslaugų vertė</th>
                    <th>Parduotuvės adresas</th>
                    <th>Atsiėmimo tipas</th>
				</tr>
			</thead>

			<tbody>
				<?php
					// suformuojame lentelę
					for($i = 0; $i < sizeof($contractData); $i++) {

						if($i == 0 || $contractData[$i]['id_Klientas'] != $contractData[$i-1]['id_Klientas']) {
							echo
								"<tr class='table-primary'>"
									. "<td colspan='6'>{$contractData[$i]['vardas']} {$contractData[$i]['pavarde']}</td>"
								. "</tr>";
						}

						if($contractData[$i]['sutarties_paslaugu_kaina'] == 0) {
							$contractData[$i]['sutarties_paslaugu_kaina'] = "neužsakyta";
						} else {
							$contractData[$i]['sutarties_paslaugu_kaina'] .= " &euro;";
						}

						echo
							"<tr>"
								. "<td>#{$contractData[$i]['kodas']}</td>"
								. "<td>{$contractData[$i]['data']}</td>"
								. "<td>{$contractData[$i]['sutarties_kaina']} &euro;</td>"
								. "<td>{$contractData[$i]['sutarties_paslaugu_kaina']}</td>"
                                . "<td>{$shop[$i]['parduotuve']}</td>"
                                . "<td>{$delivery[$i]['pristatymas']}</td>"
							. "</tr>";
						if($i == (sizeof($contractData) - 1) || $contractData[$i]['id_Klientas'] != $contractData[$i+1]['id_Klientas']) {
							if($contractData[$i]['bendra_kliento_paslaugu_kaina'] == 0) {
								$contractData[$i]['bendra_kliento_paslaugu_kaina'] = "neužsakyta";
							} else {
								$contractData[$i]['bendra_kliento_paslaugu_kaina'] .= " &euro;";
							}

							echo
								"<tr style='font-weight: 600'>"
									. "<td colspan='2'></td>"
									. "<td>{$contractData[$i]['bendra_kliento_sutarciu_kaina']} &euro;</td>"
									. "<td>{$contractData[$i]['bendra_kliento_paslaugu_kaina']}</td>"
                                    . "<td colspan='2'></td>"
								. "</tr>";
						}
					}
				?>

                <tr style='font-weight: 600'>
                    <td colspan='6'> </td>
                </tr>


				<tr style='font-weight: 600'>
                    <td colspan='1'>Bendra suma</td>
					<td colspan='1'></td>
					<td><?php echo $totalPrice[0]['uzsakymo_suma']; ?> &euro;</td>
					<td>
						<?php
							if($totalServicePrice[0]['paslaugu_suma'] == 0) {
								$totalServicePrice[0]['paslaugu_suma'] = "neužsakyta";
							} else {
								$totalServicePrice[0]['paslaugu_suma'] .= " &euro;";
							}

							echo $totalServicePrice[0]['paslaugu_suma'];
						?>
					</td>
                    <td colspan='2'></td>
				</tr>
			</tbody>
		</table>
		<a href="index.php?module=contract&action=report" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">nauja ataskaita</a>
<?php
	} else {
?>
		<div class="warningBox">
			Nurodytu laikotartpiu sutarčių sudaryta nebuvo.
		</div>
<?php
	}
?>