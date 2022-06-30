<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('title' => 'Gamintojai'));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>
    <h5 style="text-align:center;text-transform:uppercase;letter-spacing:1px;border-top:2px solid grey;border-bottom:2px solid grey;padding:10px">Gamintojų sąrašas</h5>

<div class="d-flex flex-row-reverse gap-3">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas gamintojas</a>
</div>

<?php if(isset($_GET['remove_error'])) { ?>
    <div style="border:1px solid red;border-radius:5px;padding:10px;margin:10px;" class="errorBox alert-danger">
		Gamintojas nebuvo pašalintas. Pirmiausia pašalinkite gamintojo modelius.
	</div>
<?php } ?>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Pavadinimas</th>
		<th>Irenginys</th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['id_Gamintojas']}</td>"
					. "<td>{$val['pavadinimas']}</td>"
                    . "<td>{$val['tipas']}</td>"
					. "<td class='d-flex flex-row-reverse gap-2'>"
						. "<a href='index.php?module={$module}&action=edit&id={$val['id_Gamintojas']}'>redaguoti</a>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['id_Gamintojas']}\"); return false;'>šalinti</a>&nbsp;"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/common/paging.tpl.php';
?>