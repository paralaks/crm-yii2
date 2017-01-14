<?php

namespace app\helpers;

use yii\rbac\Rule;

class SameOwnerRule extends Rule
{
  public $name='Same Owner';

  public function execute($user, $item, $params)
  {
    $model=$params[0];

    return $user==$model->owner_id;
  }
}