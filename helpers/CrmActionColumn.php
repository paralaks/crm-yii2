<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helpers;

use Yii;
use yii\grid\ActionColumn;
/**
 * Description of CrmActionColumn
 *
 * @author Murat KURT
 */
class CrmActionColumn extends ActionColumn
{
  protected function renderDataCellContent($model, $key, $index)
  {
    $user=Yii::$app->user;
    $this->template='';

    if ($user->can('Update '.$model->modelClassName(), [$model])==true)
    {
      //$this->template.='{view}&nbsp;&nbsp;';
      $this->template.='<span style="white-space: nowrap;">{update}' . ($model->deleted_at ?  '&nbsp;&nbsp;<span class="glyphicon glyphicon-remove text-danger"></span>' : '&nbsp;&nbsp;{delete}</span>');
    }

    return parent::renderDataCellContent($model, $key, $index);
  }
}
