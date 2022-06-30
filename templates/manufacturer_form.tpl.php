<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('link' => "index.php?module={$module}&action=list", 'title' => "Gamintojai"), array("title" => !empty($id) ? "Gamintojo redagavimas" : "Naujas gamintojas"));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>

<h5 style="text-align:center;text-transform:uppercase;letter-spacing:1px;border-top:2px solid grey;border-bottom:2px solid grey;padding:10px;"><?php if(!empty($id)) { print "Gamintojo"; isset($data['pavadinimas']) ? print " \"" . $data['pavadinimas'] . "\" " : print ''; print "redagavimas"; } else echo "Naujas gamintojas"; ?></h5>

<?php if($formErrors != null) { ?>
	<div class="alert alert-danger" role="alert">
		Neįvesti arba neteisingai įvesti šie laukai:
		<?php 
			echo $formErrors;
		?>
	</div>
<?php } ?>

<form action="" method="post" class="d-grid gap-3">
	<div class="form-group">
		<label for="pavadinimas">Pavadinimas<?php echo in_array('pavadinimas', $required) ? '<span> *</span>' : ''; ?></label>
        <input type="text" id="pavadinimas" <?php if(isset($data['pavadinimas'])) { ?> <?php } ?> name="pavadinimas" class="form-control" value="<?php echo isset($data['pavadinimas']) ? $data['pavadinimas'] : ''; ?>">
        <br/>
        <label for="irenginys">Irenginys<?php echo in_array('irenginys', $required) ? '<span> *</span>' : ''; ?></label>
        <select id="irenginys" name="irenginys" class="form-select form-control">
            <option value="-1">Pasirinkite irenginį</option>
            <?php
            $brands = $brandsObj->getDeviceList();
            foreach($brands as $key => $val) {
                $selected = "";
                if(isset($data['id_Gamintojas']) && $val['id_Irenginys'] == $data['fk_Irenginysid_Irenginys']) {
                    $selected = " selected='selected'";
                }
                echo "<option{$selected} value='{$val['id_Irenginys']}'>{$val['tipas']}</option>";
            }
            ?>
        </select>
    </div>

	<?php if(isset($data['id_Gamintojas'])) { ?>
		<input type="hidden" name="id" value="<?php echo $data['id_Gamintojas']; ?>" />
	<?php } ?>

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>