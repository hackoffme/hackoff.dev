<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vklady</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php
        $table = '<table border="5px">';
        if (file_exists('data')) {
            $ar = unserialize(file_get_contents('data'));
            //print_r($ar);
            foreach ($ar as $key => $value) {
                $table .= '<tr>';
               // echo $key;
               // print_r($value);
                //echo '<br>';
                foreach ($value as $keyTd => $valueTd) {
                    $table = $table.'<td>'.$valueTd.'</td>';
                }
                $table .= '</tr>';
            }
        }
        echo $table . '</table>';
        ?>
    </body>
</html>
