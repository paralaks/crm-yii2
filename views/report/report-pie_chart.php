<?php

use app\helpers\AppHelper;

foreach ($data as &$row)
  $row['color']=Yii::$app->appHelper->getRandomColor();

$jsonData=preg_replace("/\"value\"\:\"([0-9]+)\",/im", "\"value\":\\1,", json_encode($data));

?>
<script>
var pie = new d3pie("#reportGraph", {
  "id" : "chart",
  "viewBox" : "0 0 1140 800",
  "perserveAspectRatio": "xMinYMid",

  "header": {
    "title": {
      "text": "",
      "fontSize": 26,
      "font": "open sans"
    },
    "subtitle": {
      "text": "",
      "color": "#999999",
      "fontSize": 24,
      "font": "open sans"
    },
    "titleSubtitlePadding": 9
  },
  "footer": {
    "color": "#999999",
    "fontSize": 18,
    "font": "open sans",
    "location": "bottom-left"
  },
  "size": {
    "canvasWidth": "1140",
    "canvasHeight": "800",
    "pieOuterRadius": "90%"
  },
  "data": {
    "sortOrder": "value-desc",
    "content": <?= $jsonData ?>
  },
  "labels": {
    "outer": {
      "pieDistance": 32
    },
    "inner": {
      "hideWhenLessThanPercentage": 3
    },
    "mainLabel": {
      "fontSize": <?= intVal($graphFontSize) ?>
    },
    "percentage": {
      "color": "#ffffff",
      "decimalPlaces": 0,
      "fontSize": <?= intVal($graphFontSize) ?>
    },
    "value": {
      "color": "#adadad",
      "fontSize": <?= intVal($graphFontSize) ?>
    },
    "lines": {
      "enabled": true
    },
    "truncation": {
      "enabled": true
    }
  },
  "tooltips": {
    "enabled": true,
    "type": "placeholder",
    "string": "{label} {percentage}% (<?= Yii::t('main', 'Total') ?> : {value})",
    "styles": {
      "fontSize": <?= intVal($graphFontSize) ?>
    }
  },
  "effects": {
    "pullOutSegmentOnClick": {
      "speed": 400,
      "size": 8
    }
  },
  "misc": {
    "colors": {
      "background": null, // transparent
      "segmentStroke": "#ffffff"
    },
    "gradient": {
      "enabled": true,
      "percentage": 100
    },
    "canvasPadding": {
      "top": 0,
      "left": 0
    },
    "pieCenterOffset": {
      "x": 0,
      "y": 0
    }
  }
});
</script>
