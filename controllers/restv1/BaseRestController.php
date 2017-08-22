<?php
namespace app\controllers\restv1;

use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\UnauthorizedHttpException;
use yii\web\NotFoundHttpException;

class BaseRestController extends ActiveController
{

  public function behaviors()
  {
    $behaviors=parent::behaviors();
    $behaviors['authenticator']=['class' => HttpBearerAuth::className()];

    return $behaviors;
  }

  public function checkAccess($action, $model=null, $params=[])
  {
    if ($model)
    {
      $checkModel=[$model];

      if ($model->modelClassName() == 'Lead' && $model->converted_at)
        throw new NotFoundHttpException(Yii::t('main', 'RECORD_NOT_FOUND'));

      if (Yii::$app->user->can('/' . strtolower($model->modelClassName()) . '/*', $checkModel) &&
       (Yii::$app->user->can('Update ' . $model->modelClassName(), $checkModel) || Yii::$app->user->can(ucfirst($action) . ' ' . $model->modelClassName(), $checkModel)))
        return;

      throw new UnauthorizedHttpException(Yii::t('main', 'UNAUTHORIZED_TO_ACCESS'));
    }
  }
}
