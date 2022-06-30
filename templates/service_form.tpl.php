<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Pradžia</a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?module=<?php echo $module; ?>&action=list">Paslaugos</a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php if(!empty($id)) echo "Paslaugos redagavimas"; else echo "Nauja paslauga"; ?></li>
	</ol>
</nav>

<h5 style="text-align:center;text-transform:uppercase;letter-spacing:1px;border-top:2px solid grey;border-bottom:2px solid grey;padding:10px"><?php if(!empty($id)) { print "Paslaugos"; isset($data['pavadinimas']) ? print " \"" . $data['pavadinimas'] . "\" " : print ''; print "redagavimas"; } else echo "Nauja paslauga"; ?></h5>

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
		<input type="text" id="pavadinimas" name="pavadinimas" class="form-control" value="<?php echo isset($data['pavadinimas']) ? $data['pavadinimas'] : ''; ?>">
	</div>

	<div class="form-group">
		<label for="aprasymas">Aprašymas<?php echo in_array('aprasymas', $required) ? '<span> *</span>' : ''; ?></label>
		<textarea type="text" id="aprasymas" name="aprasymas" class="form-control"><?php echo isset($data['aprasymas']) ? $data['aprasymas'] : ''; ?></textarea>
	</div>

	<div class="row w-75">
		<div class="formRowsContainer column">
			<div class="row headerRow<?php if(empty($data['paslaugos_kainos']) || sizeof($data['paslaugos_kainos']) == 1) echo ' d-none'; ?>">
				<div class="col-3">Kaina</div>
				<div class="col-3">Galioja nuo</div>
                <div class="col-3">Galioja iki</div>
			</div>
			<?php
				if(!empty($data['paslaugos_kainos']) && sizeof($data['paslaugos_kainos']) > 0) {
					foreach($data['paslaugos_kainos'] as $key => $val) {
						$disabledInputAttr = "";
						if((isset($val['neaktyvus']) && $val['neaktyvus'] == 1) || $key === 0) {
							$disabledInputAttr = "disabled='disabled'";
						}

						$disabledHiddenAttr = "";
						if($key === 0) {
							$disabledHiddenAttr = "disabled='disabled'";
						}

						$kaina_laikotarpiu = '';
						if(isset($val['kaina_laikotarpiu']) ) {
                            $kaina_laikotarpiu = $val['kaina_laikotarpiu'];
						}

						$galiojaNuo = '';
						if(isset($val['galioja_nuo']) ) {
							$galiojaNuo = $val['galioja_nuo'];
						}

                        $galiojaIki = '';
                        if(isset($val['galioja_iki']) ) {
                            $galiojaIki = $val['galioja_iki'];
                        }

						$neaktyvus = false;
						if(isset($val['neaktyvus']) && $val['neaktyvus'] == 1) {
							$neaktyvus = true;
						}
					?>
						<div class="formRow row col-12 <?php echo $key > 0 ? '' : 'd-none'; ?>">
							<div class="col-3">
								<input type="text" class="form-control" <?php if($neaktyvus == false) { ?>name="kaina_laikotarpiu[]"<?php } ?> value="<?php echo $kaina_laikotarpiu; ?>" <?php echo $disabledInputAttr ?> />
								<?php if($neaktyvus) { ?>
									<input type="hidden" name="kaina_laikotarpiu[]" value="<?php echo $kaina_laikotarpiu; ?>" />
								<?php } ?>
							</div>
							<div class="col-3">
								<input type="text" class="form-control" <?php if($neaktyvus == false) { ?>name="galioja_nuo[]"<?php } ?> value="<?php echo $galiojaNuo; ?>" <?php echo $disabledInputAttr ?> />
								<?php if($neaktyvus) { ?>
									<input type="hidden" name="galioja_nuo[]" value="<?php echo $galiojaNuo; ?>" />
								<?php } ?>
							</div>
                            <div class="col-3">
                                <input type="text" class="form-control" <?php if($neaktyvus == false) { ?>name="galioja_iki[]"<?php } ?> value="<?php echo $galiojaIki; ?>" <?php echo $disabledInputAttr ?> />
                                <?php if($neaktyvus) { ?>
                                    <input type="hidden" name="galioja_iki[]" value="<?php echo $galiojaIki; ?>" />
                                <?php } ?>
                            </div>
							<input type="hidden" class="isDisabledForEditing" name="neaktyvus[]" value="<?php echo $neaktyvus ? '1' : '0'; ?>" <?php echo $disabledHiddenAttr ?> />
							<div class="col-3" style="margin-top:5px"><a href="#" onclick="return false;" class="removeChild <?php echo $neaktyvus ? 'd-none' : ''; ?>">šalinti</a></div>
						</div>
					<?php 
					}
				}
					?>
		</div>
		<div class="w-100" style="margin-top:5px">
			<a href="#" class="addChild">Pridėti</a>
		</div>
	</div>

	<?php if(isset($data['id_Paslauga'])) { ?>
			<input type="hidden" name="id" value="<?php echo $data['id_Paslauga']; ?>" />
	<?php } ?>

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>