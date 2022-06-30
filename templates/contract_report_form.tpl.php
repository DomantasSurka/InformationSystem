<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('link' => "index.php?module=contract&action=report", 'title' => "Sutarčių ataskaita"));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>

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
		<label for="dataNuo">Užsakymai sudaryti nuo</label>
		<input type="text" id="dataNuo" name="dataNuo" class="form-control datepicker" value="<?php echo isset($data['dataNuo']) ? $data['dataNuo'] : ''; ?>">
	</div>
	
	<div class="form-group">
		<label for="dataIki">Užsakymai sudaryti iki</label>
		<input type="text" id="dataIki" name="dataIki" class="form-control datepicker" value="<?php echo isset($data['dataIki']) ? $data['dataIki'] : ''; ?>">
	</div>

    <div class="form-group">
        <label for="uzsakymu-verte">Maksimali užsakymo kaina</label>
        <input type="text" id="uzsakymu-verte" name="uzsakymu-verte" class="form-control" value="<?php echo isset($data['uzsakymu-verte']) ? $data['uzsakymu-verte'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="paslaugu-verte">Atsiemimo tipas</label>
        <select id="paslaugu-verte" name="paslaugu-verte" class="form-select form-control">
            <option value="">Pasirinkite tipą</option>
            <?php
            // išrenkame visus irenginius
            $orders = $contractsObj->getOrdersList();
            foreach($orders as $key => $val) {
                $selected = "";
                if(isset($data['uzsakymo_tipas'])) {
                    $selected = " selected='selected'";
                }
                echo "<option{$selected} value='{$val['uzsakymo_tipas']}'>{$val['uzsakymo_tipas']}</option>";
            }
            ?>
        </select>
    </div>

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Sudaryti ataskaitą">
</form>