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
}
