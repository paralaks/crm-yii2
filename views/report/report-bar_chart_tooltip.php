<?php

use app\helpers\AppHelper;

$csvData=str_ireplace("\n", '\\n', Yii::$app->appHelper->arr2Csv($data, ['label', 'value']));

?>
<style>
.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.bar {
  fill: orange;
}

.bar:hover {
  fill: orangered ;
}

.x.axis path {
#  display: none;
}

.d3-tip {
  line-height: 1;
  font-weight: bold;
  padding: 12px;
  background: #333333;
  color: #ffffff;
  border-radius: 2px;
}

/* Creates a small triangle extender for the tooltip */
.d3-tip:after {
  box-sizing: border-box;
  display: inline;
  font-size: 20px;
  width: 100%;
  line-height: 1;
  color: rgba(0, 0, 0, 0.8);
  content: "\25BC";
  position: absolute;
  text-align: center;
}

/* Style northward tooltips differently */
.d3-tip.n:after {
  margin: -1px 0 0 0;
  top: 100%;
  left: 0;
}

.tick {
  font-size:<?= $graphFontSize ?>;
}
</style>

<script>

var margin = {top: 40, right: 30, bottom: 30, left: 70},
    width = 1140 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;
var svg = d3.select("#reportGraph").append("svg")
.attr("id", "chart").attr("viewBox", "-70 -40 1140 500").attr("perserveAspectRatio", "xMinYMid");

svg.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");


var formatPercent = d3.format(".0%");
var x = d3.scale.ordinal().rangeRoundBands([0, width], .1);
var y = d3.scale.linear().range([height, 0]);
var xAxis = d3.svg.axis().scale(x).orient("bottom");

var yAxis = d3.svg.axis().scale(y).orient("left").tickFormat(formatPercent);

var tip = d3.tip().attr('class', 'd3-tip').offset([-10, 0]).html(function(d)
  {
    return "<?= Yii::t('main', 'Percentage') ?> : " + d.frequency + ' (<?= Yii::t('main', 'Total') ?> : '+ d.value+')';
  })



svg.call(tip);

data=d3.csv.parse('<?= $csvData ?>', function(d) { return { label:d.label, value:d.value, frequency:d.value }; });

valueTotal=d3.sum(data, function(d) { return d.value; });
for (var i=0, end=data.length; i<end;  i++)
  data[i].frequency= (data[i].value/valueTotal).toFixed(2);

x.domain(data.map(function(d) { return d.label; }));
y.domain([0, 1]);
//y.domain([0, d3.max(data, function(d) { return d.frequency; })]);
//y.domain([0, valueTotal]);

svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + height + ")")
    .call(xAxis);

svg.append("g")
    .attr("class", "y axis")
    .call(yAxis)
    .append("text")
    .attr("transform", "rotate(-90)")
    .attr("y", 6)
    .attr("dy", ".71em")
    .style("text-anchor", "end")
    .text("<?= Yii::t('main', 'Percentage') ?> (<?= Yii::t('main', 'Total') ?> : " +valueTotal+")");

svg.selectAll(".bar")
    .data(data)
    .enter().append("rect")
    .attr("class", "bar")
    .attr("x", function(d) { return x(d.label); })
    .attr("width", x.rangeBand())
    .attr("y", function(d) { return y(d.frequency); })
    .attr("height", function(d) { return height - y(d.frequency); })
    .on('mouseover', tip.show)
    .on('mouseout', tip.hide);
</script>


