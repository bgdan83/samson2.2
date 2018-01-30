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
class TrapezeF2Class extends FuncClass
{
    public $simpleNumberArray;

    function __construct($simpleNumberArray)
    {
        $this->simpleNumberArray = $simpleNumberArray;
    }
//((a+b)^c*(a/c)^min(a,b,c))
     function calcFormula($a, $b, $c)
    {
        $ar = array($a, $b, $c);
        $result = 0;
        $temp = 0;
        $result = $a / $c;
        $temp = parent::minimum($ar);
        $result = parent::degree($result, $temp);
        $temp = $a + $b;
        $temp = parent::degree($temp, $c);
        $result = $result * $temp;
        return $result;
    }
    
    public function calculate($ar)
    {
        for ($i = 0; $i < count($ar); $i++) {

            $ar[$i]["f"] = $this->calcFormula($ar[$i]["a"], $ar[$i]["b"], $ar[$i]["c"]);
        }
        return $ar;
    }

}
