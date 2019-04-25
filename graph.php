<?php
include_once  'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Chromelink Solutions">
    <meta name="Chromelink Solutions" content="">
    <title>  </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="container">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
          <h3 class="page-header" ><span class = "glyphicon glyphicon-user"></span> Bar Chart With Data </h3>
          <ul class="nav nav-tabs">
            <li><a href="index.php">Json Linked Charts</a></li>
            <li class="active"><a href="barchart.php">DB linked Barchart</a></li>
            <li><a href="donut.php">DB Linked Donut</a></li>
            <li> <a href="linechart.php">DB Linked LineChart</a></li>
            <li><a href="area.php">DB Linked Area</a></li>
          </ul>
          <div class="container">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
              <?php
              $PDO = Database::connect();
              $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql ="SELECT ip as IPAddress,count(*) as Quantity from totalview GROUP by ip ORDER BY Quantity DESC LIMIT 5";
              $stmt = $PDO->prepare($sql);
              $stmt ->execute();
              $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
              $phpobj =json_encode($data);
              echo '<h4> Json Data </h4>';
              echo json_encode($data);

              Database::disconnect();
              ?>
              <hr>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title"></i> PHP PDO  Mysql Morris Bar Graph - Top 5 IP Visits  </h3>
                  </div>
                  <div class="panel-body">
                    <div id="morris-bar-chart">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </body>

        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/morris.min.js"></script>
        <script src="js/raphael.min.js"></script>
        <script language="JavaScript" type="text/javascript">
        $(function() {
        var jsobj = <?php echo $phpobj; ?>;
        // Bar Chart
        Morris.Bar({
        element: 'morris-bar-chart',
        data: jsobj,
        xkey: 'IPAddress',
        ykeys: ['Quantity'],
        labels: ['Quantity'],
        // stacked : true,
        
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        resize: true,
        stacked:false,
        barColors:['#d13c3e']
        });
        });
        </script>