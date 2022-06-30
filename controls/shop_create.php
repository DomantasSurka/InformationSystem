<?php

include 'libraries/shop.class.php';
$shopObj = new shop();

$formErrors = null;
$data = array();
$data['darbuotojai'] = array();

// nustatome privalomus laukus
$required = array('adresas', 'telefonas', 'e_pastas', 'vardas', 'pavarde', 'miestas');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
    'adresas' => 20,
    'telefonas' => 20,
    'e_pastas' => 20,
    'miestas' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
    // nustatome laukų validatorių tipus
    $validations = array (
        'adresas' => 'anything',
        'telefonas' => 'anything',
        'e_pastas' => 'anything',
        'vardas' => 'anything',
        'pavarde' => 'anything',
        'miestas' => 'anything');

    // sukuriame validatoriaus objektą
    include 'utils/validator.class.php';
    $validator = new validator($validations, $required, $maxLengths);

    // laukai įvesti be klaidų
    if($validator->validate($_POST)) {
        // įrašome naują pasaugą ir gauname jos id
        $id = $shopObj->insertShop($_POST);

        // įrašome paslaugų kainas
        foreach($_POST['pavarde'] as $keyForm => $priceForm) {
            $shopObj->insertShopWorkers($id, $_POST['vardas'][$keyForm], $_POST['pavarde'][$keyForm]);
        }

        // nukreipiame į paslaugų puslapį
        common::redirect("index.php?module={$module}&action=list");
        die();
    } else {
        // gauname klaidų pranešimą
        $formErrors = $validator->getErrorHTML();
        // gauname įvestus laukus
        $data = $_POST;

        $data['darbuotojai'] = array();
        if(isset($_POST['pavarde']) && sizeof($_POST['pavarde']) > 0) {
            $i = 0;
            foreach($_POST['pavarde'] as $key => $val) {
                $data['darbuotojai'][$i]['pavarde'] = $val;
                $data['darbuotojai'][$i]['vardas'] = $_POST['vardas'][$key];
                $i++;
            }
        }
    }
}

// į paslaugų kainų masyvo pradžią įtraukiame tuščią reikšmę, kad paslaugų kainų formoje
// būtų visada išvedami paslėpti formos laukai, kuriuos galėtume kopijuoti ir pridėti norimą
// kiekį kainų
array_unshift($data['darbuotojai'], array());

// įtraukiame šabloną
include 'templates/shop_form.tpl.php';

?>