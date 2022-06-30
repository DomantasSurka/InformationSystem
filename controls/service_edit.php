<?php

include 'libraries/services.class.php';
$servicesObj = new services();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('pavadinimas', 'aprasymas', 'kaina_laikotarpiu', 'galioja_nuo', 'galioja_iki');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'pavadinimas' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'pavadinimas' => 'anything',
		'aprasymas' => 'anything',
		'kaina_laikotarpiu' => 'price',
		'galioja_nuo' => 'anything',
        'galioja_iki' => 'anything');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {

		// atnaujiname duomenis
		$servicesObj->updateService($_POST);

		$servicePricesFromDb = $servicesObj->getServicePrices($id);

		foreach($servicePricesFromDb as $priceDb) {
			$found = false;
			if(isset($_POST['kaina_laikotarpiu'])) {
				foreach($_POST['kaina_laikotarpiu'] as $keyForm => $priceForm) {
					if($priceDb['kaina_laikotarpiu'] == $_POST['kaina_laikotarpiu'][$keyForm] && $priceDb['galioja_nuo'] == $_POST['galioja_nuo'][$keyForm] && $priceDb['galioja_iki'] == $_POST['galioja_iki'][$keyForm]) {
						$found = true;
					}
				}
			}

			if(!$found) {
				$servicesObj->deleteServicePrice($id, $priceDb['galioja_nuo'], $priceDb['galioja_iki'], $priceDb['kaina_laikotarpiu']);
            }
		}

		if(isset($_POST['kaina_laikotarpiu'])) {
			foreach($_POST['kaina_laikotarpiu'] as $keyForm => $priceForm) {
				$found = false;
				foreach($servicePricesFromDb as $priceDb) {
                    if($priceDb['kaina_laikotarpiu'] == $_POST['kaina_laikotarpiu'][$keyForm] && $priceDb['galioja_nuo'] == $_POST['galioja_nuo'][$keyForm] && $priceDb['galioja_iki'] == $_POST['galioja_iki'][$keyForm]) {
                        $found = true;
                    }
				}
	
				if(!$found) {
					$servicesObj->insertServicePrices($id, $_POST['galioja_nuo'][$keyForm], $_POST['galioja_iki'][$keyForm], $priceForm);
				}
			}
		}

		common::redirect("index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();

		// gauname įvestus laukus, kad galėtume užpildyti formą
		$data = $_POST;
		if(isset($_POST['kaina_laikotarpiu'])) {
			$i = 0;
			foreach($_POST['kaina_laikotarpiu'] as $key => $val) {
				$data['paslaugos_kainos'][$i]['fk_Paslaugaid_Paslauga'] = $id;
				$data['paslaugos_kainos'][$i]['kaina_laikotarpiu'] = $val;
				$data['paslaugos_kainos'][$i]['galioja_nuo'] = $_POST['galioja_nuo'][$key];
                $data['paslaugos_kainos'][$i]['galioja_iki'] = $_POST['galioja_iki'][$key];
				$data['paslaugos_kainos'][$i]['neaktyvus'] = $_POST['neaktyvus'][$key];
				$i++;
			}
		}

		array_unshift($data['paslaugos_kainos'], array());
	}
} else {
	// tikriname, ar nurodytas elemento id. Jeigu taip, išrenkame elemento duomenis ir jais užpildome formos laukus.
	if(!empty($id)) {
		$data = $servicesObj->getService($id);
		$data['paslaugos_kainos'] = array();

		$servicePrices = $servicesObj->getServicePrices($id);
		if(sizeof($servicePrices) > 0) {
			foreach($servicePrices as $key => $val) {
				// jeigu paslaugos kaina yra naudojama, jos koreguoti neleidziame ir įvedimo laukelį padarome neaktyvų
				$priceCount = $servicesObj->getPricesCountOfOrderedServices($id, $val['galioja_nuo']);
				if($priceCount > 0) {
					$val['neaktyvus'] = 1;
				}
				$data['paslaugos_kainos'][] = $val;
			}
		}

		// į paslaugų kainų masyvo pradžią įtraukiame tuščią reikšmę, kad paslaugų kainų formoje
		// būtų visada išvedami paslėpti formos laukai, kuriuos galėtume kopijuoti ir pridėti norimą
		// kiekį kainų
		array_unshift($data['paslaugos_kainos'], array());
	}
}

// įtraukiame šabloną
include 'templates/service_form.tpl.php';

?>