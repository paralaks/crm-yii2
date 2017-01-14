<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
  public $sourcePath = '@app/views/_assets';

  public $css = [
    'css/site.css',
    'css/jquery-ui.min.css',
    'css/jquery.datetimepicker.css',
    'css/site-overrides.css',
  ];

  public $js = [
    'js/jquery-ui.min.js',
    'js/date-functions.js',
    'js/jquery.datetimepicker.min.js',
    'js/site.js',
  ];

  public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset',
  ];
}

