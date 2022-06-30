<?php
// suformuojame puslapių kelio (breadcrumb) elementų masyvą
$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('link' => "index.php?module={$module}&action=list", 'title' => "Įrenginiai"), array("title" => !empty($id) ? "Įrenginio redagavimas" : "Naujas įrenginys"));

// puslapių kelio šabloną
include 'templates/common/breadcrumb.tpl.php';
?>

<h5 style="text-align:center;text-transform:uppercase;letter-spacing:1px;border-top:2px solid grey;border-bottom:2px solid grey;padding:10px;"><?php if(!empty($id)) { print "Įrenginio"; isset($data['tipas']) ? print " \"" . $data['tipas'] . "\" " : print ''; print "redagavimas"; } else echo "Naujas įrenginys"; ?></h5>

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
        <label for="tipas">Tipas<?php echo in_array('tipas', $required) ? '<span> *</span>' : ''; ?></label>
        <input type="text" id="tipas" <?php if(isset($data['tipas'])) { ?> <?php } ?> name="tipas" class="form-control" value="<?php echo isset($data['tipas']) ? $data['tipas'] : ''; ?>">
    </div>

    <?php if(isset($data['id_Irenginys'])) { ?>
        <input type="hidden" name="id" value="<?php echo $data['id_Irenginys']; ?>" />
    <?php } ?>

    <p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

    <input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>