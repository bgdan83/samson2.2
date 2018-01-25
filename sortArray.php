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

function mysort($a, $b) {
    return  $a['a'] - $b['a'];
}

usort($array, 'mysort');

echo '<pre>';
print_r($array);


