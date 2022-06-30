<?php

include 'libraries/services.class.php';
$servicesObj = new services();

$formErrors = null;
$data = array();
$data['paslaugos_kainos'] = array();

// nustatome privalomus laukus
$required = array('pavadinimas', 'kaina_laikotarpiu', 'galioja_nuo', 'galioja_iki');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'pavadinimas' => 40,
	'aprasymas' => 300
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'pavadinimas' => 'anything',
		'aprasymas' => 'anything',
		'kaina_laikotarpiu' => 'price',
		'galioja_nuo' => 'date',
        'galioja_iki' => 'date');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);
	
	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		$id = $servicesObj->insertService($_POST);

		foreach($_POST['kaina_laikotarpiu'] as $keyForm => $priceForm) {
			$servicesObj->insertServicePrices($id, $_POST['galioja_nuo'][$keyForm], $_POST['galioja_iki'][$keyForm], $_POST['kaina_laikotarpiu'][$keyForm]);
		}

		// nukreipiame į paslaugų puslapį
		common::redirect("index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
		
		$data['paslaugos_kainos'] = array();
		if(isset($_POST['kaina_laikotarpiu']) && sizeof($_POST['kaina_laikotarpiu']) > 0) {
			$i = 0;
			foreach($_POST['kaina_laikotarpiu'] as $key => $val) {
				$data['paslaugos_kainos'][$i]['kaina_laikotarpiu'] = $val;
				$data['paslaugos_kainos'][$i]['galioja_nuo'] = $_POST['galioja_nuo'][$key];
                $data['paslaugos_kainos'][$i]['galioja_iki'] = $_POST['galioja_iki'][$key];
				$i++;
			}
		}
	}
}

// į paslaugų kainų masyvo pradžią įtraukiame tuščią reikšmę, kad paslaugų kainų formoje
// būtų visada išvedami paslėpti formos laukai, kuriuos galėtume kopijuoti ir pridėti norimą
// kiekį kainų
array_unshift($data['paslaugos_kainos'], array());

// įtraukiame šabloną
include 'templates/service_form.tpl.php';

?>