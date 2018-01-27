<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Методы
 *
 * @author Максим
 */
class ModuleClass
{

    function __construct()
    {
        
        $this->mysqli = new mysqli(HOST, USER, PASS, DB);
    }

    // ловит Get при выборе рубрики
    function getId()
    {
        if (isset($_GET['parent_id']) and isset($_GET['category_id'])) {
            $category_id = strip_tags(htmlspecialchars($_GET['category_id']));
            $category_id = $this->mysqli->real_escape_string($category_id);
            $parent_id = strip_tags(htmlspecialchars($_GET['parent_id']));
            $parent_id = $this->mysqli->real_escape_string($parent_id);
            if ($parent_id == 0) {
                return $category_id;
            } else {
                return $parent_id;
            }
        }
    }

    //принимает айдишники выводимых товаров в выбранной рубрике 
    function get_product_all($ids)
    {
        if ($ids) {
            $query = "SELECT * FROM product WHERE parent_id IN($ids)  ORDER BY price_basic";
        } else {
            $query = "SELECT * FROM product ORDER BY price_basic ";
        }
        $res = $this->mysqli->query($query);
        $products = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $products[] = $row;
        }
        return $products;
    }

    // вывод товаров на экран
    function view_product($arr)
    {
        if (is_array($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                echo $arr[$i]['product_name'] . '. цена: ' . $arr[$i]['price_basic'] . '<br>';
            }
        }
    }

    function cats_id($array, $id = false)
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
            '<a href="?category_id=' . $arr[$parent_id][$i]['id'] .
            '&parent_id=' . $parent_id . '">'
            . $arr[$parent_id][$i]['category_name'] .
            '</a>';
            //рекурсия - проверяем нет ли дочерних категорий
            ModuleClass::view_cat($arr, $arr[$parent_id][$i]['id']);
            echo '</li>';
        }
        echo '</ul>';
    }

    public function filtr_name()
    {
        if (isset($_GET['product_name'])) {
            $name = strip_tags(htmlspecialchars($_GET['product_name']));

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
                echo $arr[$i]['product_name'] . '. цена: ' . $arr[$i]['price_basic'] . '<br>';
            }
        }
    }

    public function filtr_price()
    {
        if (isset($_GET['max_price']) and isset($_GET['min_price'])) {
            $min_price = (int) strip_tags(htmlspecialchars($_GET['min_price']));
            $max_price = (int) strip_tags(htmlspecialchars($_GET['max_price']));
            $min_price = $this->mysqli->real_escape_string($min_price);
            $max_price = $this->mysqli->real_escape_string($max_price);
            $sql = "SELECT * FROM product WHERE price_basic >= " . $min_price . " AND price_basic <= " . $max_price;
            $result = $this->mysqli->query($sql);
            $arr = array();
            $row_cnt = $result->num_rows;
            //В цикле формируем массив
            for ($i = 0; $i < $row_cnt; $i++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $arr[] = $row;
            }
            for ($i = 0; $i < count($arr); $i++) {
                echo $arr[$i]['product_name'] . '. цена: ' . $arr[$i]['price_basic'] . '<br>';
            }
        }
    }

    function importXmlToBd()
    {
        if (isset($_POST['buttonImport'])) {
            $products = simplexml_load_file('2.2.xml');
            //var_dump($products);
            foreach ($products as $Товар) {
                $code = $Товар['Код'];
                $product_name = $Товар['Название'];
                $price_basic = $Товар->Цена[0];
                $price_moscow = $Товар->Цена[1];
                $density = $Товар->Свойства->Плотность;
                $white = $Товар->Свойства->Белизна;
                $format = $Товар->Свойства->Формат['0'];
                //echo $Товар->Свойства->Формат['1'];
                $type = $Товар->Свойства->Тип;
                $parent_id = $Товар->Разделы->Раздел['0'];
                //echo $Товар->Разделы->Раздел['1'];
                switch ($density) {
                    case 90 : $density = 1;
                        break;
                    case 100 : $density = 2;
                        break;
                    case 120 : $density = 3;
                        break;
                    default : $density = 0;
                }

                $format = substr($format, 1);
                switch ($format) {
                    case '3' : $format = 1;
                        break;
                    case '4' : $format = 2;
                        break;
                    case '5' : $format = 3;
                        break;
                    default : $format = 0;
                        break;
                }

                switch ($type) {
                    case 'Лазерный' : $type = 1;
                        break;
                    case 'Струйный' : $type = 2;
                        break;
                    default : $type = 0;
                        break;
                }

                switch ($parent_id) {
                    case 'Бумага' : $parent_id = 30;
                        break;
                    case 'Принтеры' : $parent_id = 34;
                        break;
                    default : $parent_id = 0;
                        break;
                }
                print_r($type);
                $query = "INSERT INTO product (
                        code, 
                        product_name, 
                        price_basic, 
                        price_moscow, 
                        density, 
                        white, 
                        format, 
                        type, 
                        parent_id)
                        VALUES( 
                        '" . $code . "', 
                         '" . $product_name . "', 
                         '" . $price_basic . "', 
                         '" . $price_moscow . "', 
                         '" . $density . "', 
                         '" . $white . "', 
                         '" . $format . "', 
                         '" . $type . "', 
                        '" . $parent_id . "')";
                $sql = $this->mysqli->query($query);
                if ($sql) {
                    echo "<p>Данные успешно добавлены в таблицу.</p>";
                } else {
                    echo "<p>Произошла ошибка.</p>";
                }
            }
        }
    }

    function exportXmlToFile()
    {
        //header('Content-type: text/xml');
        if (isset($_POST['buttonExport'])) {
            $xmlout = "<?xml version=\"1.0\" encoding=\"windows-1251\"?>\n";
            $xmlout .= "<Товары>\n";

            $db = new PDO('mysql:host=localhost;dbname=test_rubric', 'root', '');
            $stmt = $db->prepare("Select * FROM product");
            $stmt->execute();

            while ($row = $stmt->fetch()) {

                $xmlout .= "\t<Товар Код=\"" . $row['code'] . "\" Название=\"" . $row['product_name'] . "\">\n";

                $xmlout .= "\t\t<Цена Тип=\"Базовая\">" . $row['price_basic'] . "</Цена>\n";

                $xmlout .= "\t\t<Цена Тип=\"Москва\">" . $row['price_moscow'] . "</Цена>\n";

                $xmlout .= "\t\t<Свойства>\n";

                if ($row['density'] != 0) {
                    switch ($row['density']) {
                        case 1 : $row['density'] = 90;
                            break;
                        case 2 : $row['density'] = 100;
                            break;
                        case 3 : $row['density'] = 120;
                            break;
                    }

                    $xmlout .= "\t\t\t<Плотность>" . $row['density'] . "</Плотность>\n";
                }

                if ($row['white'] != 0) {
                    $xmlout .= "\t\t\t<Белизна ЕдИзм=\"%\">" . $row['white'] . "</Белизна>\n";
                }

                if ($row['format'] != 0) {
                    switch ($row['format']) {
                        case 1 : $row['format'] = 'А3';
                            break;
                        case 2 : $row['format'] = 'А4';
                            break;
                        case 3 : $row['format'] = 'А5';
                            break;
                    }
                    $xmlout .= "\t\t\t<Формат>" . $row['format'] . "</Формат>\n";
                }

                if ($row['type'] != 0) {
                    switch ($row['type']) {
                        case 1 : $row['type'] = 'Лазерный';
                            break;
                        case 2 : $row['type'] = 'Струйный';
                            break;
                        case 3 : $row['type'] = 'Матричный';
                            break;
                    }
                    $xmlout .= "\t\t\t<Тип>" . $row['type'] . "</Тип>\n";
                }
                
                $xmlout .= "\t\t</Свойства>\n";
                $xmlout .= "\t\t<Разделы>\n";

                if ($row['parent_id'] == 30) {
                    $xmlout .= "\t\t\t<Раздел>Бумага</Раздел>\n";
                }
                if ($row['parent_id'] == 31) {
                    $xmlout .= "\t\t\t<Раздел>Категория1 3 уровень</Раздел>\n";
                }
                if ($row['parent_id'] == 32) {
                    $xmlout .= "\t\t\t<Раздел>Категория1 4 уровень</Раздел>\n";
                }
                if ($row['parent_id'] == 34) {
                    $xmlout .= "\t\t\t<Раздел>Принтеры</Раздел>\n";
                }
                $xmlout .= "\t\t</Разделы>\n";
                $xmlout .= "\t</Товар>\n";
            }
            $xmlout .= "</Товары>";
            file_put_contents("1.xml", $xmlout);
        }
    }
}
?>

