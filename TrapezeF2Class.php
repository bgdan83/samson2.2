<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TrapezeF2Class
 *
 * @author Андрей
 */
class TrapezeF2Class
{
    public $simpleNumberArray;

    function __construct($simpleNumberArray)
    {
        $this->simpleNumberArray = $simpleNumberArray;
    }
//((a+b)^c*(a/c)^min(a,b,c))
    private function calcFormula($a, $b, $c)
    {
        $ar = array($a, $b, $c);
        $result = 0;
        $temp = 0;
        $result = $a / $c;
        $result = $result * $c;
        $temp = $a + $b;
        $result = $temp ^ $result;
        $temp = parent::minimum($ar);
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
