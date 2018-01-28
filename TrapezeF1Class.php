<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of simpleNumberClass
 *
 * @author Андрей
 */
class TrapezeF1Class extends FuncClass
{

    public $simpleNumberArray;

    function __construct($simpleNumberArray)
    {
        $this->simpleNumberArray = $simpleNumberArray;
    }

    function calcFormula($a, $b, $c)
    {
        $ar = array($a, $b, $c);
        $result = 0;
        $temp = 0;
        $result = $a / $c;
        $result = $result ^ $b;
        $result %= 3;
        $temp = $a * $b;
        $result += $c;
        $result = $temp ^ $result;
        $temp = minimum($ar);
        $result = $result ^ $temp;
        return $result;
    }
    
    public function calculation($ar)
    {
        for ($i = 0; $i < count($ar); $i++) {

            $ar[$i]["f"] = calcFormula($ar[$i]["a"], $ar[$i]["b"], $ar[$i]["c"]);
        }
    }

}
