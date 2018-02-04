<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'FuncClass.php';
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
        $result = parent::degree($result, $b);
        $result %= 3;
        $temp = parent::minimum($ar);
        $result = parent::degree($result, $temp);
        $temp = parent::degree($b, $c);
        $temp *= $a;
        $result += $temp;
        return $result;
    }

    public function calculate($ar)
    {
        foreach ($ar as $k => &$v) {

            $v["f"] = $this->calcFormula($v["a"], $v["b"], $v["c"]);
        }
        return $ar;
    }
    

}
