<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FuncClass
 *
 * @author Андрей
 */
class FuncClass
{

    public function minimum($ar)
    {

        $result = 0;
        foreach ($ar as $a) {
            if ($result > $a)
                $result = $a;
        }

        return $result;
    }

    public function oddNumber($ar)
    {
        foreach ($ar as $k => &$val) {
            if (($val["s"] % 2) != 0) {
                $val["d"] = &$val["s"];
            } else {
                $val["d"] = 0;
            }
        }
        return $ar;
    }

    function degree($number, $pow)
    {
        $result = 1;
        for ($i = 0; $i < $pow; $i++) {
            $result *= $number;
        }
        return $result;
    }

}
