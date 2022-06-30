<?php
// suformuojame puslapių kelio (breadcrumb) elementų masyvą
$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('title' => 'Parduotuvės'));

// puslapių kelio šabloną
include 'templates/common/breadcrumb.tpl.php';
?>
    <h5 style="text-align:center;text-transform:uppercase;letter-spacing:1px;border-top:2px solid grey;border-bottom:2px solid grey;padding:10px">Parduotuvių sąrašas</h5>

    <div class="d-flex flex-row-reverse gap-3">
        <a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja parduotuvė</a>
    </div>

<?php if(isset($_GET['remove_error'])) { ?>
    <div style="border:1px solid red;border-radius:5px;padding:10px;margin:10px;" class="errorBox alert-danger">
        Parduotuvė nebuvo pašalinta. Pirmiausia pašalinkite ją iš esamų užsakymų.
    </div>
<?php } ?>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Adresas</th>
            <th>Telefonas</th>
            <th>El. Paštas</th>
            <th>Miestas</th>
            <th></th>
        </tr>
        <?php
        // suformuojame lentelę
        foreach($data as $key => $val) {
            echo
                "<tr>"
                . "<td>{$val['id_Parduotuve']}</td>"
                . "<td>{$val['adresas']}</td>"
                . "<td>{$val['telefonas']}</td>"
                . "<td>{$val['e_pastas']}</td>"
                . "<td>{$val['miestas']}</td>"
                . "<td class='d-flex flex-row-reverse gap-2'>"
                . "<a href='index.php?module={$module}&action=edit&id={$val['id_Parduotuve']}'>redaguoti</a>"
                . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['id_Parduotuve']}\"); return false;'>šalinti</a>&nbsp;"
                . "</td>"
                . "</tr>";
        }
        ?>
    </table>

<?php
// įtraukiame puslapių šabloną
include 'templates/common/paging.tpl.php';
?>