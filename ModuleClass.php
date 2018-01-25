<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Методы
 *
 * @author Андрей
 */
class ModuleClass
{

    function __construct()
    {
        //Создаем свойство содержащее объект MySQLi
        $this->mysqli = new mysqli(HOST, USER, PASS, DB);
    }

    function getId()
    {
        if (isset($_GET['parent_id']) and isset($_GET['category_id'])) {
            $parent_id = strip_tags(htmlspecialchars($_GET['parent_id']));
            $parent_id = $this->mysqli->real_escape_string($parent_id);
            return $parent_id;
        }
    }

    function get_product_all($ids)
    {
        if ($ids) {
            $query = "SELECT * FROM product WHERE parent_id IN($ids)  ORDER BY price";
        } else {
            $query = "SELECT * FROM product ORDER BY price ";
        }
        $res = $this->mysqli->query($query);
        $products = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $products[] = $row;
        }
        return $products;
    }

    function view_product($arr)
    {
        if (is_array($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                echo $arr[$i]['product_name'] . '. цена: ' . $arr[$i]['price'] . '<br>';
            }
        }
    }

    function cats_id($array, $id)
    {
        if (!$id)
            return false;
        $data = '';
        foreach ($array as $item) {
            if ($item['parent_id'] == $id) {
                $data .= $item['id'] . ",";
                $data .= ModuleClass::cats_id($array, $item['id']);
            }
        }
        return $data;
    }

    //Функция получения массива каталога
    function get_cats()
    {
        $query = "SELECT * FROM category";
        $res = $this->mysqli->query($query);

        $arr_cat = array();
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $arr_cat[$row['id']] = $row;
        }
        return $arr_cat;
    }

    function get_cat()
    {
        //запрос к базе данных
        $sql = "SELECT * FROM category";
        $result = $this->mysqli->query($sql);
        if (!$result) {
            return NULL;
        }
        $arr_cat = array();
        if ($result->num_rows != 0) {

            //В цикле формируем массив
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);

                //Формируем массив, где ключами являются адишники на родительские категории
                if (empty($arr_cat[$row['parent_id']])) {
                    $arr_cat[$row['parent_id']] = array();
                }
                $arr_cat[$row['parent_id']][] = $row;
            }

            return $arr_cat;
        }
    }

//вывод каталога с помощью рекурсии
    public function view_cat($arr, $parent_id = 0)
    {

        //Условия выхода из рекурсии
        if (empty($arr[$parent_id])) {
            return;
        }
        echo '<ul>';
        //перебираем в цикле массив и выводим на экран
        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
            echo '<li>' .
            '<a href="?category_id=' .
            $arr[$parent_id][$i]['id'] .
            '&parent_id=' . $parent_id . '">'
            . $arr[$parent_id][$i]['category_name'] .
            '</a>';
            //рекурсия - проверяем нет ли дочерних категорий
            ModuleClass::view_cat($arr, $arr[$parent_id][$i]['id']);
            echo '</li>';
        }
        echo '</ul>';
    }

    public function filtr()
    {

        if (isset($_GET['name'])) {
            $name = strip_tags(htmlspecialchars($_GET['name']));
            if (!isset($name)) {
                return NULL;
            }
            $t = array();
            $name = $this->mysqli->real_escape_string($name);
            //$name = substr($name, 0, 6);
            $t[] = "(product_name LIKE '%$name%')";
            if ($t) {
                $d = "WHERE";
                $t = implode(" AND ", $t);
            } else {
                $d = "";
            }


            $sql = "SELECT * FROM product $d $t";

            //$sql = "SELECT * FROM product WHERE product_name = ". $name ;

            $result = $this->mysqli->query($sql);

            if (!$result) {
                echo 'Поиск';
            }

            $arr = array();
            $row_cnt = $result->num_rows;
            //В цикле формируем массив
            for ($i = 0; $i < $row_cnt; $i++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);

                $arr[] = $row;
            }


            for ($i = 0; $i < count($arr); $i++) {
                echo $arr[$i]['product_name'] . '. цена: ' . $arr[$i]['price'] . '<br>';
            }
        }
    }

}
?>

