<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <?php
        include 'TrapezeF1Class.php';
        include 'TrapezeF2Class.php';
        include 'EchoTableClass.php';
        $arrTrapeze = array(
            array(
                "a" => 11,
                "b" => 13,
                "c" => 17
            ),
            array(
                "a" => 19,
                "b" => 23,
                "c" => 29
            ),
            array(
                "a" => 31,
                "b" => 37,
                "c" => 41
            ),
            array(
                "a" => 43,
                "b" => 47,
                "c" => 53
            )
        );
        for ($i = 0; $i < count($arrTrapeze); $i++) {
            $arrTrapeze[$i]["s"] = (($arrTrapeze[$i]["a"] +
                    $arrTrapeze[$i]["b"]) * $arrTrapeze[$i]["c"]) / 2;
        }
        $f1 = new TrapezeF1Class($arrTrapeze);
        $arrTrapeze1 = $f1->calculate($arrTrapeze);
        $arrTrapeze1 = $f1->oddNumber($arrTrapeze1);
        $echot = new EchoTableClass();
        $f2 = new TrapezeF2Class($arrTrapeze);
        $arrTrapeze2 = $f2->calculate($arrTrapeze);
        $arrTrapeze2 = $f2->oddNumber($arrTrapeze2);
        $echot->getValue($arrTrapeze1);
        $echot->getValue($arrTrapeze2);
        ?>
    </body>
</html><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

