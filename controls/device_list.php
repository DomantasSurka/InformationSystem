<?php

// sukuriame markių klasės objektą
include 'libraries/device.class.php';
$deviceObj = new device();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $deviceObj->getDevicesListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

$data = $deviceObj->getDevicesList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/device_list.tpl.php';

?>