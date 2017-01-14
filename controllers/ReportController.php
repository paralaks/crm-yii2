<?php
namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
use app\models\Report;
use yii\helpers\Html;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class ReportController extends Controller
{
  /**
   * Lists all Reports .
   *
   * @return mixed
   */
  public function actionIndex()
  {
    $model=new Report();
    $data=[];

    $reportObjects=array_keys($model->graphReports);

    $dropdownJS='<script>';
    $dropdownObjects=[];
    foreach ($model->graphReports as $k=>$v)
    {
      $dropdownObjects[$k]=$v['label'];

      $tmp=[];
      foreach ($v['labels'] as $k2=>$v2)
        $tmp[]='"'.HTML::encode($k2).'", "'.HTML::encode($v2).'"';

      $dropdownJS.='var '.$k.'=['.implode(',', $tmp).'];'.PHP_EOL;
    }
    $dropdownJS.='</script>';


    $dropdownTypes=$model->graphReports[current($reportObjects)]['labels'];

    if ($model->load(Yii::$app->request->post()))
    {
      if (!in_array($model->report_object,  $reportObjects))
        $model->report_object=current($reportObjects);

      $dropdownTypes=$model->graphReports[$model->report_object]['labels'];
      $reportTypes=$model->graphReports[$model->report_object]['reports'];

      if (!array_key_exists($model->report_type, $reportTypes))
        $model->report_type=current($reportTypes);

      $query = new Query();
      $query->select($model->report_type.' as fieldId, count(*) as total')->from($model->report_object)->where('deleted_at is NULL')->groupBy($model->report_type);
      $resultList=$query->all();

      foreach($resultList as $result)
      {
        if (empty($reportTypes[$model->report_type]))
          $label=HTML::encode($result['fieldId']);
        else
          $label=Yii::$app->appHelper->getLookupValue($reportTypes[$model->report_type], $result['fieldId'], false);

        $data[]=['label'=>($label ? $label : '?'), 'value'=>$result['total']];
      }
    }

    return $this->render('index', [ 'model'=>$model, 'data'=>$data, 'dropdownObjects'=>$dropdownObjects, 'dropdownTypes'=>$dropdownTypes, 'dropdownJS'=>$dropdownJS ]);
  }
}
