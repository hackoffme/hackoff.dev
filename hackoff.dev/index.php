<html>
    <head>
        <meta charset='utf-8'>
        <title>'1'</title>
         <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="src/excanvas.js"></script><![endif]-->
        <script language="javascript" type="text/javascript" src="src/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="src/jquery.jqplot.js"></script>
        <script language="javascript" type="text/javascript" src="src/plugins/jqplot.dateAxisRenderer.js"></script>
        <link rel="stylesheet" type="text/css" href="src/jquery.jqplot.css" />
    </head>
    <body>
        
        <?php
        $valuteID='R01235';
        $valuteName['R01235']='USD';
        $valuteName['R01239']='EURO';
        if (isset($_POST['button'])){
            $valuteID=$_POST['selectValute'];
        }
        $Url = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=";
        for ($i = 0; $i < 10; $i++) {
            $date = date('d/m/Y', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y')));
            $dateForJava = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y')));
            $filename='/opt/lampp/docs/hackoff.dev/'.$dateForJava.$valuteName[$valuteID];
            $UrlDate = $Url . $date ;
            if (file_exists($filename)) {
                $xml = simplexml_load_file($filename);
            } else {
               $xml = simplexml_load_file($UrlDate); 
               $xml->asXML($filename);
            }
            $valute = $xml->xpath(".//*[@ID='".$valuteID."']");
            $valuteList[] = [$dateForJava, floatval(str_replace(',', '.', $valute[0]->Value))];
        }
        ?>   

        <div id='plot' style="width:500px;height:400px"></div>
        <script>
            var ar = <?php echo json_encode($valuteList) ?>;
            var plot1 = $.jqplot('plot', [ar], {
                title: <?php echo json_encode($valuteName[$valuteID]);?>,
                axes: {
                    xaxis: {
                        renderer: $.jqplot.DateAxisRenderer,
                        tickOptions: {
                            formatString: '%Y-%m-%d'
                        }
                    },
                    yaxis: {
                        tickOptions: {
                            formatString: '$%.2f'
                        }
                    }
                },
                highlighter: {
                    show: true,
                    sizeAdjust: 7.5
                },
                cursor: {
                    show: false
                }
            });
        </script>
        <form action="index.php" method="post" name='form'>
            <select name='selectValute'>
                <option  value="R01235">USD</option>
                <option value="R01239">EURO</option>
                <input name='button' type="submit" value="Отправить">
            </select>
        </form>
    </body>
</html>