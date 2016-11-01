<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Админка</title>
    </head>
    <body>
        <form enctype="multipart/form-data" method="post">
            <p><input type="file" name="excel">
                <input type="submit" value="Отправить"></p>
        </form>
        <?php
        require_once '/opt/lampp/docs/hackoff.dev/Classes/PHPExcel.php';

        //var_dump($_FILES['exel']['tmp_name']);
        //echo file_exists($_FILES['exel']['tmp_name']);
        if (array_key_exists('excel', $_FILES)) {
            $excel = PHPExcel_IOFactory::load($_FILES['excel']['tmp_name']);
            var_dump($excel);
        }
        
        ?>
    </body>
</html>
