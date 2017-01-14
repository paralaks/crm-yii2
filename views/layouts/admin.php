<?php
use yii\helpers\Html;

ob_start();

$controller = $this->context;
$menus = $controller->module->menus;
$route = $controller->route;
foreach ($menus as $i => $menu) {
  $menus[$i]['active'] = strpos($route, trim($menu['url'][0], '/')) === 0;
}
$this->params['nav-items'] = $menus;

?>
  <div id="manager-menu" class="list-group col-lg-2">
     <br>
      <?php
      foreach ($menus as $menu) {
          $label = Html::tag('i', '', ['class' => 'glyphicon glyphicon-chevron-right pull-right']) .
              Html::tag('span', Html::encode($menu['label']), []);
          $active = $menu['active'] ? ' active' : '';
          echo Html::a($label, $menu['url'], [
              'class' => 'list-group-item' . $active,
          ]);
      }
      ?>
  </div>
<?php

$adminContent=ob_get_contents();
ob_end_clean();

include 'main.php';

