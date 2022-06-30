<?php

include 'libraries/shop.class.php';
$shopObj = new shop();

$formErrors = null;
$data = array();

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

        $shopObj->updateShop($_POST);

        $shopWorkersFromDb = $shopObj->getShopWorkers($id);

        foreach($shopWorkersFromDb as $priceDb) {
            $found = false;
            if(isset($_POST['pavarde'])) {
                foreach($_POST['pavarde'] as $keyForm => $priceForm) {
                    if($priceDb['vardas'] == $_POST['vardas'][$keyForm] && $priceDb['pavarde'] == $_POST['pavarde'][$keyForm]) {
                        $found = true;
                    }
                }
            }

            if(!$found) {
                $shopObj->deleteShopWorker($id, $priceDb['vardas'], $priceDb['pavarde']);
            }
        }

        if(isset($_POST['pavarde'])) {
            foreach($_POST['pavarde'] as $keyForm => $priceForm) {
                $found = false;
                foreach($shopWorkersFromDb as $priceDb) {
                    if($priceDb['vardas'] == $_POST['vardas'][$keyForm] && $priceDb['pavarde'] == $_POST['pavarde'][$keyForm]) {
                        $found = true;
                    }
                }

                if(!$found) {
                    $shopObj->insertShopWorkers($id, $_POST['vardas'][$keyForm], $_POST['pavarde'][$keyForm]);
                }
            }
        }

        // nukreipiame į paslaugų puslapį
        common::redirect("index.php?module={$module}&action=list");
        die();
    } else {
        // gauname klaidų pranešimą
        $formErrors = $validator->getErrorHTML();

        // gauname įvestus laukus, kad galėtume užpildyti formą
        $data = $_POST;
        if(isset($_POST['pavarde'])) {
            $i = 0;
            foreach($_POST['pavarde'] as $key => $val) {
                $data['darbuotojai'][$i]['fk_Parduotuveid_Darbuotojas'] = $id;
                $data['darbuotojai'][$i]['pavarde'] = $val;
                $data['darbuotojai'][$i]['vardas'] = $_POST['vardas'][$key];
                $data['darbuotojai'][$i]['neaktyvus'] = $_POST['neaktyvus'][$key];
                $i++;
            }
        }

        array_unshift($data['darbuotojai'], array());
    }
} else {
    // tikriname, ar nurodytas elemento id. Jeigu taip, išrenkame elemento duomenis ir jais užpildome formos laukus.
    if(!empty($id)) {
        $data = $shopObj->getShop($id);
        $data['darbuotojai'] = array();

        $servicePrices = $shopObj->getShopWorkers($id);
        if(sizeof($servicePrices) > 0) {
            foreach($servicePrices as $key => $val) {
                $data['darbuotojai'][] = $val;
            }
        }

        array_unshift($data['darbuotojai'], array());
    }
}

// įtraukiame šabloną
include 'templates/shop_form.tpl.php';

?>