<?php
namespace app\controllers\restv1;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

class BaseRestController extends ActiveController
{
  public function behaviors()
  {
    $behaviors = parent::behaviors();
    $behaviors['authenticator'] =  ['class' =>  HttpBearerAuth::className() ];

    return $behaviors;
  }

  public function checkAccess($action, $model = null, $params = [])
  {
    if ($model)
      if (Yii::$app->user->can('/'.strtolower($model->modelClassName()).'/*', [$model]) &&
        (Yii::$app->user->can('Update '.$model->modelClassName(), [$model]) || Yii::$app->user->can(ucfirst($action).' '.$model->modelClassName(), [$model])))
        return;
      else
        throw new \yii\web\UnauthorizedHttpException('You are not authorized to perform that operation.');
  }
}
