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

        $result = $ar[0];

        for ($i = 1; $i < count($ar); $i++) {
            if ($result > $ar[$i])
                $result = $ar[$i];
        }

        return $result;
    }

    public function calculation($ar)
    {
        for ($i = 0; $i < count($ar); $i++) {

            $ar[$i]["f"] = calcformula1($ar[$i]["a"], $ar[$i]["b"], $ar[$i]["c"]);
        }
    }

}
