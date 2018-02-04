<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * выводит таблицу с результатами
 *
 * @author Максим
 */
class EchoTableClass
{

    // отрисовывает табдицу и выводит результаты
    public function getValue($ar)
    {
        echo '<table border = "1">';
        for ($i = 0; $i < count($ar); $i++) {
            echo '<tr>';
            foreach ($ar[$i] as $a => $val) {
                echo '<td>' . $val . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

}
