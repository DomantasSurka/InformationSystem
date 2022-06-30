<?php

include 'libraries/manufacturer.class.php';
$brandsObj = new manufacturer();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $brandsObj->getManufacturerListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

$data = $brandsObj->getManufacturerList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/manufacturer_list.tpl.php';

?>