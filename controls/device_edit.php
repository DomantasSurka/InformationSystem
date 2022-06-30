<?php

include 'libraries/device.class.php';
$deviceObj = new device();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('tipas');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
    'tipas' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
    // nustatome laukų validatorių tipus
    $validations = array (
        'tipas' => 'anything');

    // sukuriame validatoriaus objektą
    include 'utils/validator.class.php';
    $validator = new validator($validations, $required, $maxLengths);

    if($validator->validate($_POST)) {
        // atnaujiname duomenis
        $deviceObj->updateDevice($_POST);

        common::redirect("index.php?module={$module}&action=list");
        die();
    } else {
        // gauname klaidų pranešimą
        $formErrors = $validator->getErrorHTML();
        // gauname įvestus laukus
        $data = $_POST;
    }
} else {
    // išrenkame elemento duomenis ir jais užpildome formos laukus.
    $data = $deviceObj->getDevice($id);
}

// įtraukiame šabloną
include 'templates/device_form.tpl.php';

?>