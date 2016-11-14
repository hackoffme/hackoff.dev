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
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4 col-md-offset-4">
                    <?php
                    $table = '<table  class="table table-striped table-bordered table-hover table-condensed">';
                    if (file_exists('data')) {
                        $ar = unserialize(file_get_contents('data'));
                        foreach ($ar as $key => $value) {
                            $table .= '<tr>';
                            foreach ($value as $keyTd => $valueTd) {
                                $table = $table . '<td>' . $valueTd . '</td>';
                            }
                            $table .= '</tr>';
                        }
                    }
                    echo $table . '</table>';
                    //plural_form('1', array('месяц', 'месяца', 'месяцев'));
                    //var_dump(get_defined_vars());
                    ?>
                    <div id="calc">
                        <div class="row">
                            <div class="col-md-4">Сумма вклада</div>
                            <div class="col-md-4">
                                <div><input type="text" name="chance" id="chance" class="text" value="300000" max="1500000">
                                    <input type="range" id="chanceSlider" min="20000" value="300000" max="1500000" step="10000" style="background-color: #00aec8; width: 50%;">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">Срок</div>
                            <div class="col-md-4">
                                <select name="period" id='period'>
                                    <?php
                                    for ($index = 1; $index < count($ar); $index++) {
                                        echo '<option value="' . $ar[$index][0] . '">' . plural_form($ar[$index][0], array('месяц', 'месяца', 'месяцев')) . '</option>';
                                    }

                                    function plural_form($number, $after) {
                                        $cases = array(2, 0, 1, 1, 1, 2);
                                        return $number . ' ' . $after[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
                                    }
                                    ?>
                                </select>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Сумма процентов</div>
                            <div class="col-md-4">
                                <div id="summa">123</div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        ar = <?php echo json_encode($ar); ?>;
                        $('#chanceSlider').change(function () {
                            $('#chance').val($('#chanceSlider').val());
                            changeCalc();
                        });
                        $('#period').change(function () {
                            changeCalc();
                        });

                        function changeCalc() {
                            var summaVklada = document.getElementById('chanceSlider').value;
                            var srokVklada = document.getElementById('period').value;
                            var IsrokVklad = 0;
                            var IsummaVklada = 0;

                            for (var i = 1; i < ar.length; i++) {
                                if (ar[i][0] > srokVklada) {
                                    IsrokVklad = i - 1;
                                    break;
                                }
                            }

                            if (IsrokVklad == 0) {
                                IsrokVklad = ar.length - 1;
                            }

                            for (var i = 1; i < ar[0].length; i++) {
                                if (ar[0][i] > summaVklada) {
                                    IsummaVklada = i - 1;
                                    break;
                                }
                            }

                            if (IsummaVklada == 0) {
                                IsummaVklada = ar[0].length - 1;
                            }

                            var summaProcentov = summaVklada * srokVklada * ar[IsrokVklad][IsummaVklada] / 1200;
                            document.getElementById('summa').innerHTML = summaProcentov;
                            //alert(ar[IsrokVklad][IsummaVklada]);
                            //alert(summaProcentov);

                        }
                    </script>
                </div>

            </div>
        </div>
    </body>
</html>
