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
        $Url = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=";
        for ($i = 0; $i < 10; $i++) {
            $date = date('d/m/Y', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y')));
            $dateForJava = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y')));
            $UrlDate = $Url . $date;
            $xml = simplexml_load_file($Url);
            $valute = $xml->xpath(".//*[@ID='R01239']");
            $valuteList[$dateForJava] = floatval(str_replace(',', '.', $valute[0]->Value));
        }
        ?>   

        <div id='plot' style="width:500px;height:400px"></div>
        <script>
            // alert($.parseJSON(data));

            var ar = <?php echo json_encode($valuteList) ?>;
            var arToGraph=[];
            for (var item in ar) {
              // alert(item);
              // alert(ar[item]);
              arToGraph.push([item,ar[item]]);
               

            }
            var line1 = [['2016-10-11', 578.55], ['2016-10-12', 566.5], ['2016-10-13', 480.88], ['2016-10-14', 509.84]];
            //var a = Array.from(ar);

             //alert(line1);
            //alert(arToGraph);

            var plot1 = $.jqplot('plot', [arToGraph], {
                title: 'Data Point Highlighting',
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

    </body>
</html>