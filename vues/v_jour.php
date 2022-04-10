
<?php
include "utils/php_serial.class.php";
?>
  
  <meta http-equiv="refresh" content="3600; URL=http://localhost/www/PhpSerieTest/">
<?php 
$jour = $pdo->getDateOfTheDay();
;
$lesTemperatures = $pdo->getLesDernieresTemperatures();
?>
<h3>Les temperatures du dernier jour <?php echo $jour[0] ?> : </h3>
<?php


$serial = new phpSerial;
 $serial->phpSerial();
 $serial->deviceSet("COM4");
 $serial->confBaudRate(9600);
 $serial->deviceOpen();
 $read = "";
 $temperature = $serial->readPort($read, 4, 5);      // Lecture port uart
 if($temperature != "") {
  $pdo->insertTemperature($temperature);              // Insert new value with current_timestamp
 }
$serial->deviceClose();

$maxTemp = -50;
$minTemp = 50;

$dataPoints = array();      
// Trouver les températures maximal / minimal et transformer le format heure hh,mm en hh.mm
foreach ($lesTemperatures as $key => $value) {      
    if ($lesTemperatures[$key]['temperature'] > $maxTemp){
        $maxTemp = $lesTemperatures[$key]['temperature'];
    }
    if ($lesTemperatures[$key]['temperature'] < $minTemp)
        $minTemp = $lesTemperatures[$key]['temperature'];

    $lesTemperatures[$key]['moment'][2] = ".";
}
$index = 1;   

foreach ($lesTemperatures as $key => $value) {      // attribuer les valeurs du graphe
    if($lesTemperatures[$key]['temperature'] === $minTemp) {
        array_push($dataPoints, array("x"=> substr($lesTemperatures[$key]['moment'], 0, 2), "y"=> $lesTemperatures[$key]['temperature'], "indexLabel"=> "Lowest"));
        $index++;
    } elseif ($lesTemperatures[$key]['temperature'] === $maxTemp) {
        array_push($dataPoints, array("x"=> substr($lesTemperatures[$key]['moment'], 0, 2), "y"=> $lesTemperatures[$key]['temperature'], "indexLabel"=> "Highest"));
        $index++;
    } else {
        array_push($dataPoints, array("x"=> substr($lesTemperatures[$key]['moment'], 0, 2), "y"=> $lesTemperatures[$key]['temperature']));
        $index++;
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    theme: "light2",
    title:{
        text: "Graphe Des Dernières Températures Recueillies"
    },
    axisY:{
        includeZero: true
    },
    data: [{
        type: "column",
        indexLabel: "{yp}", 
        indexLabelFontColor: "#5A5757",
        indexLabelPlacement: "outside",   
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="utils/canvasjs.min.js"></script>
</body>
</html>         
                     