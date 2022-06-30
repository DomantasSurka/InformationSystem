<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Pradžia</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="index.php?module=<?php echo $module; ?>&action=list">Parduotuvė</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php if(!empty($id)) echo "Parduotuvės redagavimas"; else echo "Nauja parduotuvė"; ?></li>
    </ol>
</nav>

<h5 style="text-align:center;text-transform:uppercase;letter-spacing:1px;border-top:2px solid grey;border-bottom:2px solid grey;padding:10px"><?php if(!empty($id)) { print "Parduotuvės"; isset($data['adresas']) ? print " (" . $data['adresas'] . ") " : print ''; print "redagavimas"; } else echo "Nauja parduotuvė"; ?></h5>

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
        <label for="adresas">Adresas<?php echo in_array('adresas', $required) ? '<span> *</span>' : ''; ?></label>
        <input type="text" id="adresas" name="adresas" class="form-control" value="<?php echo isset($data['adresas']) ? $data['adresas'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="telefonas">Telefonas<?php echo in_array('telefonas', $required) ? '<span> *</span>' : ''; ?></label>
        <input type="text" id="telefonas" name="telefonas" class="form-control" value="<?php echo isset($data['telefonas']) ? $data['telefonas'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="e_pastas">El. Paštas<?php echo in_array('e_pastas', $required) ? '<span> *</span>' : ''; ?></label>
        <input type="text" id="e_pastas" name="e_pastas" class="form-control" value="<?php echo isset($data['e_pastas']) ? $data['e_pastas'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="miestas">Miestas<?php echo in_array('miestas', $required) ? '<span> *</span>' : ''; ?></label>
        <select id="miestas" name="miestas" class="form-select form-control">
            <option value="-1">Pasirinkite miestą</option>
            <?php
            // išrenkame visus irenginius
            $cities = $shopObj->getCityList();
            foreach($cities as $key => $val) {
                $selected = "";
                if(isset($data['id_Parduotuve']) && $val['id_Miestas'] == $data['fk_Miestasid_Miestas']) {
                    $selected = " selected='selected'";
                }
                echo "<option{$selected} value='{$val['id_Miestas']}'>{$val['pavadinimas']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="row w-75">
        <div class="formRowsContainer column">
            <div class="row headerRow<?php if(empty($data['darbuotojai']) || sizeof($data['darbuotojai']) == 1) echo ' d-none'; ?>">
                <div class="col-4">Vardas</div>
                <div class="col-4">Pavardė</div>
            </div>
            <?php
            if(!empty($data['darbuotojai']) && sizeof($data['darbuotojai']) > 0) {
                foreach($data['darbuotojai'] as $key => $val) {
                    $disabledInputAttr = "";
                    if((isset($val['neaktyvus']) && $val['neaktyvus'] == 1) || $key === 0) {
                        $disabledInputAttr = "disabled='disabled'";
                    }

                    $disabledHiddenAttr = "";
                    if($key === 0) {
                        $disabledHiddenAttr = "disabled='disabled'";
                    }

                    $vardas = '';
                    if(isset($val['vardas']) ) {
                        $vardas = $val['vardas'];
                    }

                    $pavarde = '';
                    if(isset($val['pavarde']) ) {
                        $pavarde = $val['pavarde'];
                    }

                    $neaktyvus = false;
                    if(isset($val['neaktyvus']) && $val['neaktyvus'] == 1) {
                        $neaktyvus = true;
                    }
                    ?>
                    <div class="formRow row col-12 <?php echo $key > 0 ? '' : 'd-none'; ?>">
                        <div class="col-4">
                            <input type="text" class="form-control" <?php if($neaktyvus == false) { ?>name="vardas[]"<?php } ?> value="<?php echo $vardas; ?>" <?php echo $disabledInputAttr ?> />
                            <?php if($neaktyvus) { ?>
                                <input type="hidden" name="vardas[]" value="<?php echo $vardas; ?>" />
                            <?php } ?>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" <?php if($neaktyvus == false) { ?>name="pavarde[]"<?php } ?> value="<?php echo $pavarde; ?>" <?php echo $disabledInputAttr ?> />
                            <?php if($neaktyvus) { ?>
                                <input type="hidden" name="pavarde[]" value="<?php echo $pavarde; ?>" />
                            <?php } ?>
                        </div>
                        <input type="hidden" class="isDisabledForEditing" name="neaktyvus[]" value="<?php echo $neaktyvus ? '1' : '0'; ?>" <?php echo $disabledHiddenAttr ?> />
                        <div class="col-4" style="margin-top:5px"><a href="#" onclick="return false;" class="removeChild <?php echo $neaktyvus ? 'd-none' : ''; ?>">šalinti</a></div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="w-100"  style="margin-top:5px">
            <a href="#" class="addChild">Pridėti</a>
        </div>
    </div>

    <?php if(isset($data['id_Parduotuve'])) { ?>
        <input type="hidden" name="id" value="<?php echo $data['id_Parduotuve']; ?>" />
    <?php } ?>

    <p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

    <input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>