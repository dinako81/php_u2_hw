<?php

function generateIBAN($bankAccountNumber) {
    $countryCode = 'LT';
    $controlNumber = '00'; // pradinė reikšmė
    $iban = $countryCode . $controlNumber . $bankAccountNumber;
    
    // Patikriname banko sąskaitos numerio validumą
    if (!validateBankAccountNumber($bankAccountNumber)) {
      return false;
    }
  
    // Paskaičiuojame kontrolinį skaičių
    $controlNumber = str_pad(98 - bcmod($iban . '282000', '97'), 2, '0', STR_PAD_LEFT);
    
    // Generuojame IBAN
    $iban = $countryCode . $controlNumber . $bankAccountNumber;
    
    return $iban;
  }
  
  function validateBankAccountNumber($bankAccountNumber) {
    // Patikriname ar banko sąskaitos numeris yra tinkamas Lietuvoje
    if (!preg_match('/^[0-9]{16}$/', $bankAccountNumber)) {
      return false;
    }
    
    // Patikriname ar banko sąskaitos numeris yra teisingas pagal kontrolinę sumą
    $checksum = substr($bankAccountNumber, 2) . '282000' . substr($bankAccountNumber, 0, 2);
    return bcmod($checksum, '97') === '1';
  }