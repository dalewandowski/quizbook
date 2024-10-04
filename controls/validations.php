<?php

function validateInput($data)
{



    $stringValidate =  '/^[A-Z][a-zà-öø-ÿ]*$/';

    if (preg_match($stringValidate, $data)) {
        $checkSubmit = false;
        $_SESSION['errName'] = "Imie musi zaczynać się wielką literą";
    }
};
