<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$string = "abcdbce";
$reversString = "bc";


    try {
    $iterator = strripos($string, $reversString);
    $string = substr_replace($string, strrev($reversString), $iterator, strlen($reversString));
} catch (Exception $e) {
    echo 'Поймано исключение: ', $e->getMessage(), "\n";
}
echo $string;
