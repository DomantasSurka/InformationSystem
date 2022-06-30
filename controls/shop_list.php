<?php

include 'libraries/shop.class.php';
$shopObj = new shop();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $shopObj->getShopListCount();

include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio paslaugas
$data = $shopObj->getShopList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/shop_list.tpl.php';

?>