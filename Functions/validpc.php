<?php

function validateLithuanianID($id){
    return preg_match('/^[3-6]\d{2}[0-1]\d[0-3]\d{4}$/',$id);
}