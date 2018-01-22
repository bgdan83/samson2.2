<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * расчитывает по формуле f2=((a+b)^c*(a/c)^min(a,b,c))
 *
 * @author Максим
 */
class TrapezeF2Class extends FuncClass
{

    public $simpleNumberArray;

    function __construct($simpleNumberArray)
    {
        $this->simpleNumberArray = $simpleNumberArray;
    }

    // расчет по формуле для трех переменных
    public function calcFormula($a, $b, $c)
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

    // подствляет формулу для расчета многомерного массива
    public function calculate($ar)
    {
        for ($i = 0; $i < count($ar); $i++) {

            $ar[$i]["f"] = TrapezeF2Class::calcFormula($ar[$i]["a"], $ar[$i]["b"], $ar[$i]["c"]);
        }
        return $ar;
    }

}
