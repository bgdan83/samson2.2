<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$array = array(
    array(
        'a' => 3,
    ),
    array(
        'a' => 2,
        'b' => 8,
    ),
    array(
        'a' => 1,
        'b' => 8,
    ),
);
try {

    function mysort($a, $b)
    {
        return $a['a'] / 0;
    }

    usort($array, 'mysort');
} catch (Exception $e) {
    echo 'Поймано исключение: ', $e->getMessage(), "\n";
}
echo '<pre>';
print_r($array);

