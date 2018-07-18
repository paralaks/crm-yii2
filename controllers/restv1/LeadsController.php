<?php
namespace app\controllers\restv1;

use Yii;
use app\models\Lead;
use app\models\LeadConvertForm;
use yii\web\BadRequestHttpException;

class LeadsController extends BaseRestController
{
  public $modelClass = 'app\models\Lead';

  public function actionConvert($id) {
    $lead=Lead::findOne($id);
    $this->checkAccess('convert', $lead, null);

    $model=new LeadConvertForm();
    $result=$model->convert($lead, "post");

    if ($result==null || $result[0]=='')
      throw new BadRequestHttpException();

    return $result;
  }
}
