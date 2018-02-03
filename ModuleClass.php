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

    //принимает ID выводимых товаров в выбранной рубрике 
    function get_product_all($ids)
    {
        if ($ids) {
            $query = "SELECT product.product_name, price.price_value "
                   . "FROM product "
                   . "INNER JOIN price ON product.id = price.product_id "
                   . "AND product.parent_id IN($ids) "
                   . "AND price.type = 'базовая'";
        } else {
            $query = "SELECT product.product_name, price.price_value FROM product, price WHERE product.id = price.product_id  AND price.type = 'базовая'";
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
                echo $arr[$i]['product_name'] . '. цена: ' . $arr[$i]['price_value'] . '<br>';
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

    function getCatId()
    {
        $query = "SELECT id, category_name FROM category";
        $res = $this->mysqli->query($query);

        $arr_cat = array();

        $row_cnt = $res->num_rows;
        //В цикле формируем массив
        for ($i = 0; $i < $row_cnt; $i++) {
            $row = $res->fetch_array(MYSQLI_ASSOC);
            $arr[] = $row;
        }
        return $arr;
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
        if (!empty($_GET['product_name'])) {
            $name = strip_tags(htmlspecialchars($_GET['product_name']));
            $name = $this->mysqli->real_escape_string($name);
            $sql = "SELECT product.product_name, price.price_value FROM product "
                    . "INNER JOIN price "
                    . "ON product.id = price.product_id  "
                    . "AND price.type = 'базовая'"
                    . " AND product_name LIKE '%$name%'";
            $result = $this->mysqli->query($sql);

            if ($result->num_rows == 0) {
                echo 'Товар не найден';
            }
            $arr = array();
            $row_cnt = $result->num_rows;
            //В цикле формируем массив
            for ($i = 0; $i < $row_cnt; $i++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $arr[] = $row;
            }
            for ($i = 0; $i < count($arr); $i++) {
                echo $arr[$i]['product_name'] . '. цена: ' . $arr[$i]['price_value'] . '<br>';
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
            $sql = "SELECT product.product_name, price.price_value FROM product "
                    . "INNER JOIN price "
                    . "ON product.id = price.product_id "
                    . "AND price.type = 'базовая'"
                    . "AND price_value >= " . $min_price . " "
                    . "AND price_value <= " . $max_price;
            $result = $this->mysqli->query($sql);
            $arr = array();
            $row_cnt = $result->num_rows;
            //В цикле формируем массив
            for ($i = 0; $i < $row_cnt; $i++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $arr[] = $row;
            }
            for ($i = 0; $i < count($arr); $i++) {
                echo $arr[$i]['product_name'] . '. цена: ' . $arr[$i]['price_value'] . '<br>';
            }
        }
    }

    function importXmlToBd()
    {
        if (isset($_POST['buttonImport'])) {
            $products = simplexml_load_file('2.2.xml') or die("Error: Cannot create object");

            foreach ($products as $Товар) {
                $code = $Товар['Код'];
                $product_name = $Товар['Название'];
                $price = $Товар->Цена;
                $properties = $Товар->Свойства;
                $categories = $Товар->Разделы->Раздел;
                $temp = 0;
                $arr = ModuleClass::getCatId();
                $arr = array_column($arr, 'category_name', 'id');
                //print_r($arr);

                $query = "INSERT INTO product (
                        code, 
                        product_name)
                        VALUES( 
                        '" . $code . "', 
                         '" . $product_name . "' 
                        )";
                $sql = $this->mysqli->query($query);
                if ($sql) {
                    echo "<p>Данные свойств успешно добавлены в таблицу.</p>";
                } else {
                    echo "<p>Произошла ошибка.</p>";
                }
                $id = $this->mysqli->insert_id;

                foreach ($properties as $property) {
                    foreach ($property as $k => $v) {
                        $query = "INSERT INTO properties SET
                        product_id = '" . $id . "',
                        properties_name = '" . $k . "' , 
                        properties_value = '" . $v . "'";
                        $sql = $this->mysqli->query($query);
                        if ($sql) {
                            echo "<p>Данные свойств успешно добавлены в таблицу.</p>";
                        } else {
                            echo "<p>Произошла ошибка.</p>";
                        }
                    }
                }

                for ($i = 0, $j = count($price); $i < $j; $i++) {
                    $query = "INSERT INTO price SET
                        product_id = '" . $id . "',
                        type = '" . $price[$i]->attributes() . "' , 
                        price_value = '" . $price[$i] . "'";
                    $sql = $this->mysqli->query($query);
                    if ($sql) {
                        echo "<p>Данные цен успешно добавлены в таблицу.</p>";
                    } else {
                        echo "<p>Произошла ошибка.</p>";
                    }
                }

                foreach ($categories as $category) {
                    $temp = array_search($category, $arr);
                    $query = "INSERT INTO product_to_category SET
                        product_id = '" . $id . "',
                        category_id = '" . $temp . "'";
                    $sql = $this->mysqli->query($query);
                    if ($sql) {
                        echo "<p>Данные категорий успешно добавлены в таблицу.</p>";
                    } else {
                        echo "<p>Произошла ошибка.</p>";
                    }
                }
            }
        }
    }

    function exportXmlToFile()
    {
        //header('Content-type: text/xml');
        if (isset($_POST['buttonExport'])) {


            $db = new PDO('mysql:host=localhost;dbname=test_rubric', 'root', '');
            $stmt = $db->prepare("SELECT id, product_name, code FROM product");
            $stmt->execute();

            $xml = new DOMDocument("1.0", "windows-1251");

            $products = $xml->appendChild($xml->createElement("Товары"));

            while ($row = $stmt->fetch()) {

                $product = $xml->createElement("Товар");
                $products->appendChild($product);
                $product->setAttribute("Код", $row['code']);
                $product->setAttribute("Название", $row['product_name']);

                $stmt1 = $db->prepare("SELECT price_value, type "
                                    . "FROM price "
                                    . "WHERE product_id = '" . $row['id'] . "'");
                $stmt1->execute();
                while ($row1 = $stmt1->fetch()) {
                    $price = $xml->createElement("Цена", $row1['price_value']);
                    $product->appendChild($price);
                    $price->setAttribute("Тип", $row1['type']);
                }

                $properties = $xml->createElement("Свойства");
                $product->appendChild($properties);

                $stmt2 = $db->prepare("SELECT properties_name, properties_value "
                                    . "FROM properties "
                                    . "WHERE product_id = '" . $row['id'] . "'");
                $stmt2->execute();
                while ($row2 = $stmt2->fetch()) {
                    $properties1 = $xml->createElement($row2['properties_name'], $row2['properties_value']);
                    $properties->appendChild($properties1);
                }

                $categories = $xml->createElement("Разделы");
                $product->appendChild($categories);
                $stmt3 = $db->prepare("SELECT c.category_name 
                                        FROM category c 
                                        INNER JOIN product_to_category ptg ON ptg.category_id = c.id
                                        WHERE ptg.product_id = '" . $row['id'] . "'");
                $stmt3->execute();
                while ($row3 = $stmt3->fetch()) {
                    $category = $xml->createElement("Раздел", $row3['category_name']);
                    $categories->appendChild($category);
                }
            }

            
            $xml->formatOutput = true;
            print $xml->save("1.xml");
            /*           //$xmlout = "<?xml version=\"1.0\" encoding=\"windows-1251\"?>\n";
              //$xmlout .= "<Товары>\n";
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
             * 
             */
        }
    }

}
?>

