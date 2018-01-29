<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //include "subStringReverse.php";
        //include "sortArray.php";
        /**
         * Основная точка входа
         */
        //Отправляем заголовок с кодировкой
        //header("Content-Type:text/html;charset=utf8");
        //Подключаем файл с функциями и файл конфигурации
        include 'ModuleClass.php';
        include 'config.php';
        //соединение с базой данных
        $db = new ModuleClass();
        //$db->connect(HOST, USER, PASS, DB);
        //получаем массив каталога
        ?>
        <table border="1" width="100%" width="640" height="600" cellpadding="5">
            <tr height = "50">
                <td>
                    <?php
                    $result_cat = $db->get_cat();
                    //Выводим каталог на экран с помощью рекурсивной функции
                    $db->view_cat($result_cat);
                    ?>

                </td>
                <td>
                    <form action="" method="get">
                        <p><b>Введите название товара</b></p>
                        <p><input name ="product_name" type="text" size="40"></p>
                        <p><input type="submit"></p>
                    </form>

                    <form action="" method="get">
                        <p><b>Минимальная цена</b>
                            <input name ="min_price" type="text" size="10"></p>
                        <b>Максимальная цена</b>
                        <input name ="max_price" type="text" size="10"></p>
                        <p><input type="submit"></p>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    $id = $db->getId();
                    $result = $db->get_cats();
                    $ids = $db->cats_id($result, $id);
                    $ids = !$ids ? $id : rtrim($ids, ",");
                    $ids = rtrim($ids, ",");
                    $result = $db->get_product_all($ids);
                    if (isset($_GET['product_name']) or ( isset($_GET['min_price']) and isset($_GET['max_price']))) {
                        $db->filtr_name();
                        $db->filtr_price();
                    } else {
                        $db->view_product($result);
                    }
                    ?>
                </td>

                <?php
                if (isset($_POST['buttonImport'])) {
                    copy($_FILES['xmlFile']['tmp_name'], $_FILES['xmlFile']['name']);
                }
                ?>


                <td>
                    <form method="post" enctype ="multipart/form-data">
                        <p><b>XML файл</b>
                            <input type="file" name="xmlFile"></p>
                        <p><input type="submit" value="Загрузить" name="buttonImport"></p>
                    </form>
                    <?php
                    $db->importXmlToBd();
                    $db->exportXmlToFile();
                    ?>
                    <form method="post" enctype ="multipart/form-data">
                        <p><b>Создать XML</b>  
                            <input type="submit" value="Выгрузить" name="buttonExport"></p>
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>
