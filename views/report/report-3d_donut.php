<?php

use app\helpers\AppHelper;

foreach ($data as &$row)
  $row['color']=Yii::$app->appHelper->getRandomColor();

$jsonData=str_ireplace('"color"', 'color', json_encode($data));

?>
<style>
  path.slice{
    stroke-width:2px;
  }
  polyline{
    opacity: .3;
    stroke: black;
    stroke-width: 2px;
    fill: none;
  }
  svg text.percent{
    fill:white;
    text-anchor:middle;
    font-size:<?= $graphFontSize ?>;
  }
</style>

<script>
  var data=<?= $jsonData ?>;
  var svg = d3.select("#reportGraph").append("svg").attr("width", 1140).attr("height", 800).attr("id", "chart").attr("viewBox", "0 0 1140 800").attr("perserveAspectRatio", "xMinYMid");
  svg.append("g").attr("id","donut1");

  Donut3D.draw("donut1", data, 570, 370, 500, 350, 60, 0.2);
//Donut3D.draw("donut2", data, 150, 150, 130, 100, 30, 0.4);

</script>