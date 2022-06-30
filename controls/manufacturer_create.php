<?php

include 'libraries/manufacturer.class.php';
$brandsObj = new manufacturer();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('pavadinimas', 'irenginys');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'pavadinimas' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'pavadinimas' => 'anything',
        'irenginys' => 'positivenumber');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// įrašome naują įrašą
		$brandsObj->insertManufacturer($_POST);

		common::redirect("index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
	}
}

// įtraukiame šabloną
include 'templates/manufacturer_form.tpl.php';

?>