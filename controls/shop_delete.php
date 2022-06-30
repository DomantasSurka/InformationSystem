<?php

include 'libraries/shop.class.php';
$shopObj = new shop();

if(!empty($id)) {
    // patikriname, ar šalinama paslauga nenaudojama jokioje sutartyje
    $contractCount = $shopObj->getOrderCountOfShops($id);

    $removeErrorParameter = '';
    if($contractCount == 0) {
        // pašaliname paslaugos kainas
        $shopObj->deleteAllShopWorkers($id);

        // pašaliname paslaugą
        $shopObj->deleteShop($id);
    } else {
        $removeErrorParameter = '&remove_error=1';
    }

    // nukreipiame į paslaugų puslapį
    common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
    die();
}

?>