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
        $Url .= date('d/m/Y');
        $xml = simplexml_load_file($Url);
        $valute = $xml->xpath(".//*[@ID='R01100']");

        //print_r($valute);
       // echo date('d/m/Y', mktime(0, 0, 0, date('m'), date('d') - 10, date('Y')));
        ?>   

        <div id='plot' style="width:500px;height:400px"></div>
        <script>
            var line1 = [['10/10/2016', 578.55], ['11/10/2016', 566.5], ['12/10/2016', 480.88], ['13/10/2016', 509.84]];
            var plot1 = $.jqplot('plot', [line1], {
                title: 'Data Point Highlighting',
                axes: {
                    xaxis: {
                        renderer: $.jqplot.DateAxisRenderer,
                        tickOptions: {
                            formatString: '%d/%m/%Y'
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