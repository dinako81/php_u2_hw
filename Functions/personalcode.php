<?php

// 10.	Asmens kodas turi būti tikrinamas ar atitinka taisykles.

function generatePersonalCode($length = 11) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $personal_code = '';
  
    for ($i = 0; $i < $length; $i++) {
      $personal_code .= $characters[rand(0, strlen($characters) - 1)];
    }
  
    return $personal_code;
  }


  file_put_contents(__DIR__ . '/personalcode.json', json_encode($personal_code));

 





//   https://lt.wikipedia.org/wiki/Asmens_kodas