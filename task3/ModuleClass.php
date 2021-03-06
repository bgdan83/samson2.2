<?php
include 'config.php';
/**
 * Весь функционал пока что здесь
 *
 *
 */
class ModuleClass
{
    /**
     * @var
     */
    public static $arParent;

    /**
     * ModuleClass constructor.
     */
    function __construct()
    {
        $this->mysqli = new mysqli(HOST, USER, PASS, DB);
        $this->mysqli->set_charset("utf8");
    }


    /**
     * ловит Get при выборе рубрики
     * @return mixed
     */
    function getId()
    {
        if (isset($_GET['parent_id'])) {
             return $_GET['parent_id'];
        }
    }


    /**
     * принимает ID выводимых товаров в выбранной рубрике
     * @param $ids
     * @return array
     */
    function get_product_all($ids)
    {
        if ($ids) {
            $query = "SELECT p.product_name, price.price_value
                      FROM product p
                      INNER JOIN product_to_category ptc ON p.id = ptc.product_id
                      INNER JOIN category c ON ptc.category_id = c.id
                                            AND c.id IN ($ids) 
                      INNER JOIN price ON p.id = price.product_id  
                                       AND price.type = 'базовая'";
        } else {
            $query = "SELECT product.product_name, price.price_value FROM product  "
                    . "INNER JOIN price ON product.id = price.product_id  "
                    . "AND price.type = 'базовая'";
        }
        $res = $this->mysqli->query($query);
        $products = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $products[] = $row;
        }
        return $products;
    }


    /**
     * вывод товаров на экран
     * @param $arr
     */
    function view_product($arr)
    {
        if (is_array($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                echo $arr[$i]['product_name'] . '. цена: ' . 
                     $arr[$i]['price_value'] . '<br>';
            }
        }
    }

    /**
     * @param $array
     * @param bool $id
     * @return bool|string
     */
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


    /**
     * @return array
     */
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

    /**
     * @return array|null
     */
    function get_cat()
    {
        $sql = "SELECT * FROM category";
        $result = $this->mysqli->query($sql);
        if (!$result) {
            return NULL;
        }
        $arr_cat = [];
        if ($result->num_rows != 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $arr_cat['SECTIONS'][$row['parent_id']][$row['id']] = $row;
                $arr_cat['PARENT'][$row['id']] = $row['parent_id'];
            }
            return $arr_cat;
        }
    }

    /**
     * получение всех категорий предков
     * @param $arr
     * @param $id
     */
    static function getParent($arr, $id) {
        foreach ($arr['SECTIONS'] as $parentID => $arGroupSection) {
            if ($id !== 0 && isset($arGroupSection[$id])) {
                static::$arParent[$id] = false;
               self::getParent($arr, $parentID);
            }
        }
    }


    /**
     * вывод каталога
     * @param $arr
     * @param int $parent_id
     * @param array $arSelected
     */
    public function view_cat($arr, $parent_id = 0, $arSelected = [])
    {
        $requestId = 0;
        if (isset($_GET['category_id'])) {
            $requestId  = $_GET['category_id'];
        }
        self::getParent($arr, $requestId);
        $parentView = isset($arr['SECTIONS'][$parent_id][$requestId])
            && empty($arr['SECTIONS'][$requestId]);
        echo '<ul>';
        foreach($arr['SECTIONS'][$parent_id] as $sectionID => $arSection) {
            echo '<li' .  (
                $parent_id == 0
                || $parent_id == $requestId
                || $parentView
                || isset(static::$arParent[$sectionID])
                    ? '' : ' style="display:none"') . '>' .
            '<a href="?category_id=' . $arSection['id'] . '">'
            . $arSection['category_name'] .
            '</a>';
            if (!empty($arr['SECTIONS'][$arSection['id']])) {
                ModuleClass::view_cat($arr, $sectionID, $arSelected);
            }
            echo '</li>';
        }
        echo '</ul>';
    }

    /**
     *
     */
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

    /**
     *
     */
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

    //Функция получения массива каталога

    /**
     * @return array
     */
    function get_cats()
    {
        $query = "SELECT id, parent_id FROM category";
        $res = $this->mysqli->query($query);

        $arr_cat = array();
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $arr_cat[$row['id']] = $row;
        }
        return $arr_cat;
    }

    /**
     *
     */
    function importXmlToBd($fileName)
    {

        $products = simplexml_load_file($fileName) or die("Error: Cannot create object");

        foreach ($products as $Товар) {
            $code = $Товар['Код'];
            $product_name = $Товар['Название'];
            $price = $Товар->Цена;
            $properties = $Товар->Свойства;
            $categories = $Товар->Разделы->Раздел;
            $temp = 0;
            $arr = self::getCatId();
            $arr = array_column($arr, 'category_name', 'id');

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
                        units = '" . $v->attributes() . "' , 
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

    /**
     *
     */
    function exportXmlToFile()
    {
        //header('Content-type: text/xml');
        if (isset($_POST['buttonExport'])) {
            $db = new PDO('mysql:host=localhost;dbname=test_rubric;charset=UTF8', 'root', '');
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

                $stmt2 = $db->prepare("SELECT properties_name, properties_value, units "
                                    . "FROM properties "
                                    . "WHERE product_id = '" . $row['id'] . "'");
                $stmt2->execute();
                while ($row2 = $stmt2->fetch()) {
                    $properties1 = $xml->createElement($row2['properties_name'], $row2['properties_value']);
                    if (!empty($row2['units'])){
                        $properties1->setAttribute("ЕдИзм", $row2['units']);
                    }
                    $properties->appendChild($properties1);
                }

                $categories = $xml->createElement("Разделы");
                $product->appendChild($categories);
                $stmt3 = $db->prepare(
                    "SELECT c.category_name                               
                    FROM category c 
                    INNER JOIN product_to_category ptg ON ptg.category_id = c.id
                    WHERE ptg.product_id = '" . $row['id'] . "'"
                );
                $stmt3->execute();
                while ($row3 = $stmt3->fetch()) {
                    $category = $xml->createElement("Раздел", $row3['category_name']);
                    $categories->appendChild($category);
                }
            }
            $xml->formatOutput = true;
            $file = "exportgoods.xml";
            $xml->save($file);
            if (file_exists($file)) {
                // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
                // если этого не сделать файл будет читаться в память полностью!
                if (ob_get_level()) {
                    ob_end_clean();
                }
                // заставляем браузер показать окно сохранения файла
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                // читаем файл и отправляем его пользователю
                readfile($file);
                exit;
            }
        }
    }
}
?>

