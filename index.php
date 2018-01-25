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
        $result_cat = $db->get_cat();

        //Выводим каталог на экран с помощью рекурсивной функции
        echo '<div style="width:350px;float:left; padding:10px; border:1px solid #074776">';
        $db->view_cat($result_cat);
        echo '</div>';

        $id = $db->getId();
        $result = $db->get_cats();
        $ids = $db->cats_id($result, $id);
        $ids = !$ids ? $id : rtrim($ids, ",");
        

        $result = $db->get_product_all($ids);
        //print_r($result);
        $db->view_product($result);
        ?>
        <form action="" method="get">
            <p><b>Введите название товара</b></p>
            <p><input name ="name" type="text" size="40"></p>
            <p><input type="submit"></p>
        </form>
        <?php
        $db->filtr();

        if (isset($_POST['buttonImport'])) {
            copy($_FILES['xmlFile']['tmp_name'], $_FILES['xmlFile']['name']);
        }
        ?>
        <hr>


        <form method="post" enctype ="multipart/form-data">
            XML File <input type="file" name="xmlFile">
            <br>
            <input type="submit" value="Загрузить" name="buttonImport">
        </form>


    </body>
</html>
