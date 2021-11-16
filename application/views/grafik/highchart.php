<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<title><?= $title; ?></title>
    <style>
        .highcharts-figure, .highcharts-data-table table {
            min-width: 310px; 
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

    </style>
</head>
<body>
    
    <figure class="highcharts-figure">
    <div id="container"></div>
</figure>
 
 <script>
     Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Data barang masuk'
            },
            subtitle: {
                text: 'tanggal : <?= date('d F Y'); ?>'
            },
            xAxis: {
                categories: [
                <?php foreach($semuabarang as $barang) : ?>'<?= $barang['nama_barang'] ?>',
                <?php endforeach; ?>
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumalh barang masuk'
                }
            },
            // tooltip: {
            //     headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            //     pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            //         '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            //     footerFormat: '</table>',
            //     shared: true,
            //     useHTML: true
            // },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Jumlah',
                data: [

                    <?php foreach($semuabarang as $barang) : ?><?= $barang['jumlah']; ?>,
                    <?php endforeach; ?>

                ]

            }]
        });
 </script>   
</body>
</html>