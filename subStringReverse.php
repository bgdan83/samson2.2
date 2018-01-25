<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$string = "abcdbce";
$reversString = "bc";

if ((substr_count($string, $reversString) == 2)) {
    
    $iterator = strripos($string, $reversString);
    $string = substr_replace($string, strrev($reversString), $iterator, strlen($reversString));
} else {
    echo "Неверное колличество вхождений подстроки!";
}
echo $string;
