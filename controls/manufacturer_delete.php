<?php

include 'libraries/manufacturer.class.php';
$brandsObj = new manufacturer();

if(!empty($id)) {
	$count = $brandsObj->getModelCountOfManufacturer($id);

	$removeErrorParameter = '';
	if($count == 0) {
		$brandsObj->deleteManufacturer($id);
	} else {
		$removeErrorParameter = '&remove_error=1';
	}

	common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}

?>