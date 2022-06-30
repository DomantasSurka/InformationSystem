<?php

include 'libraries/device.class.php';
$deviceObj = new device();

if(!empty($id)) {
    $count = $deviceObj->getManufacturerCountOfDevice($id);

    $removeErrorParameter = '';
    if($count == 0) {
        $deviceObj->deleteDevice($id);
    } else {
        $removeErrorParameter = '&remove_error=1';
    }

    common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
    die();
}

?>