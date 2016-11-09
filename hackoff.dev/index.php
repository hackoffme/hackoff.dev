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

        if (array_key_exists('excel', $_FILES)) {
            $excel = PHPExcel_IOFactory::load($_FILES['excel']['tmp_name']);
            $ar = array();
            $ar = $excel->getActiveSheet()->toArray();
            unset($excel);
            $ser = serialize($ar);
//            foreach ($ar as $key => $value) {
//                echo '<br>';
//                print_r($value);
//            }
            file_put_contents('data', serialize($ar));
        }
        
        ?>
        <a href="vklady.php">Vklady</a>
    </body>
</html>
