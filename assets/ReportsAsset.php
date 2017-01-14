<?php

namespace app\assets;

use yii\web\AssetBundle;

class ReportsAsset extends AssetBundle
{
  public $sourcePath = '@app/views/_assets';
  public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];

  public $css = [
  ];

  public $js = [
    'js/d3.min.js',
    'js/d3.tip.js',
    'js/d3.pie.js',
    'js/d3.donut3d.js',
  ];

  public $depends = [
  ];
}

