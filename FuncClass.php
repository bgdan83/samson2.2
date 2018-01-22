<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * библиотека общих методов
 *
 * @author Андрей
 */
class FuncClass
{

    // расчет минимума для функций
    public function minimum($ar)
    {
        $result = $ar[0];

        for ($i = 1; $i < count($ar); $i++) {
            if ($result > $ar[$i])
                $result = $ar[$i];
        }

        return $result;
    }

    // выбирает трапецию с нечетной площадью
    public function oddNumber($ar)
    {
        for ($i = 0; $i < count($ar); $i++) {
            if (($ar[$i]["s"] % 2) != 0) {
                $ar[$i]["d"] = &$ar[$i]["s"];
            } else {
                $ar[$i]["d"] = 0;
            }
        }
        return $ar;
    }

}
