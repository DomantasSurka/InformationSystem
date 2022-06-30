<?php
// suformuojame puslapių kelio (breadcrumb) elementų masyvą
$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('title' => 'Įrenginiai'));

// puslapių kelio šabloną
include 'templates/common/breadcrumb.tpl.php';
?>
    <h5 style="text-align:center;text-transform:uppercase;letter-spacing:1px;border-top:2px solid grey;border-bottom:2px solid grey;padding:10px">Įrenginių sąrašas</h5>

    <div class="d-flex flex-row-reverse gap-3">
        <a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas įrenginys</a>
    </div>

<?php if(isset($_GET['remove_error'])) { ?>
    <div style="border:1px solid red;border-radius:5px;padding:10px;margin:10px;" class="errorBox alert-danger">
        Įrenginys nebuvo pašalintas. Pirmiausia pašalinkite irenginio gamintojus.
    </div>
<?php } ?>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Tipas</th>
        </tr>
        <?php
        // suformuojame lentelę
        foreach($data as $key => $val) {
            echo
                "<tr>"
                . "<td>{$val['id_Irenginys']}</td>"
                . "<td>{$val['tipas']}</td>"
                . "<td class='d-flex flex-row-reverse gap-2'>"
                . "<a href='index.php?module={$module}&action=edit&id={$val['id_Irenginys']}'>redaguoti</a>"
                . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['id_Irenginys']}\"); return false;'>šalinti</a>&nbsp;"
                . "</td>"
                . "</tr>";
        }
        ?>
    </table>

<?php
// įtraukiame puslapių šabloną
include 'templates/common/paging.tpl.php';
?>