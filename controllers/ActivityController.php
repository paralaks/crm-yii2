<?php
namespace app\controllers;

use Yii;
use app\models\Activity;
use app\models\ActivitySearch;
use yii\db\Query;
use app\models\ActivityMorph;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends CrmController
{
  /**
   * Lists all Activity models.
   *
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel=new ActivitySearch();
    $dataProvider=$searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
  }

  public function getExcludedRelatedIds($id=0, $relatedTypeId=0)
  {
    if (empty($id))
      return null;

    $query=new Query();
    return $query->select('related_id')
                  ->from('rel_activity_morph')
                  ->where(['and', ['related_type_id' => $relatedTypeId, 'activity_id'=>$id, 'deleted_at'=> null]])
                  ->column();
  }

  protected function saveRelatedList($model, $deletedRelations, $relatedTypeId, $tableName)
  {
    $success='';
    $error='';

    // undeletes first
    $hashUndeleted=[];
    if ($deletedRelations)
      foreach ($deletedRelations as $relation)
      {
        $relation->deleted_at=null;

        if ($relation->save())
          $success.='<li><span class="glyphicon glyphicon-ok-sign"></span> ' . Yii::$app->appHelper->getValueFromTable($tableName, $relation->related_id);
        else
          $error.='<li><span class="glyphicon glyphicon-remove-sign"></span> ' . Yii::$app->appHelper->getValueFromTable($tableName, $relation->related_id);

        $hashUndeleted[$relation->related_id]=true;
      }

    foreach ($model->idList as $relatedId)
    {
      // skip undeleted records
      if (isset($hashUndeleted[$relatedId]))
        continue;

      $relation=new ActivityMorph();
      $relation->activity_id=$model->id;
      $relation->related_type_id=$relatedTypeId;
      $relation->related_id=$relatedId;

      if ($relation->save())
        $success.='<li>' . Yii::$app->appHelper->getValueFromTable($tableName, $relatedId);
      else
        $error.='<li>' . Yii::$app->appHelper->getValueFromTable($tableName, $relatedId);
    }

    if ($success != '')
      Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'Activity added successfully to record(s) below.') . "<ul>$success</ul>");
    if ($error != '')
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'Activity could not be added to record(s) below.') . "<ul>$error</ul>");
  }

  /**
   * Creates a new Activity model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @return mixed
   */
  public function actionCreate()
  {
    $model=new Activity();

    list($relatedTypeId, $tableName, $this->keywordLabel) =Yii::$app->appHelper->getRelatedTypeInfo($model->related_type);

    // model data is loaded in model object
    if (Yii::$app->request->isGet)
    {
      // fake a search to display form
      if ($model->related_id)
      {
        $this->keyword=Yii::$app->appHelper->getValueFromTable($tableName, $model->related_id);

        $this->searchResults[0]['id']=$model->related_id;
        $this->searchResults[0]['name']=$this->keyword;
        $this->searchResults[0]['!']=true;
      }
    }
    else if (Yii::$app->request->isPost)
    {
      // post is for saving?
      if ($this->formSubmit == 'save' && $model->save())
      {
        if (empty($model->idList))
          Yii::$app->session->setFlash('pageError', Yii::t('main', 'SELECT_FROM_SEARCH_RESULTS'));
        else
        {
          $this->saveRelatedList($model, null, $relatedTypeId, $tableName);

          return $this->redirect(['view', 'id' => $model->id]);
        }
      }

      // then just run a search
      $this->excludeIds=$this->getExcludedRelatedIds($model->id, $relatedTypeId);

      list($this->searchResults, $this->tooManyResults)=$this->searchRecordsByName($tableName, $this->keyword, 100, $this->excludeIds);
    }

    return $this->render('create', ['model' => $model, 'controller' => $this]);
  }

  public function deleteUndeleteRelated($id, $delete=true)
  {
    $model=new Activity();

    if ($delete)
    {
      $successMessage=Yii::t('main', 'DELETE_SUCCEEDED');
      $successUrl=Html::a(Yii::t('main', 'Undo'), Url::to(['activity/undeleterelated', 'id' => $id, 'related_type' => $model->related_type, 'related_id' => $model->related_id]));
      $errorMessage=Yii::t('main', 'DELETE_FAILED');
      $deletedAtWhere='deleted_at IS NULL';
      $deletedAtValue=date('Y-m-d H:i:s');
    }
    else
    {
      $successMessage=Yii::t('main', 'Record undeleted successfully.');
      $successUrl='';
      $errorMessage=Yii::t('main', 'Error occured while undeleting record.');
      $deletedAtWhere='deleted_at IS NOT NULL';
      $deletedAtValue=null;
    }

    if (Yii::$app->request->isGet && $id)
    {
      if ($model->related_type && $model->related_id &&
          ($related=ActivityMorph::find()->where('activity_id=' . intVal($id) . ' AND related_type_id=' . Yii::$app->appHelper->getRelatedTypeId($model->related_type) .
            ' AND related_id=' . intVal($model->related_id) . ' AND '.$deletedAtWhere)->one()))
      {
        $related->deleted_at=$deletedAtValue;

        if ($related->save())
          Yii::$app->session->setFlash('pageSuccess', $successMessage . ' ' .$successUrl);
        else
          Yii::$app->session->setFlash('pageError', $errorMessage);
      }
      else
        Yii::$app->session->setFlash('pageError', Yii::t('main', 'Record could not be found.'));

      return $this->redirect(['view', 'id' => $id]);
    }
    else
      return $this->redirect(['index']);
  }

  public function actionDeleterelated($id)
  {
    $this->deleteUndeleteRelated($id, true);
  }

  public function actionUndeleterelated($id)
  {
    $this->deleteUndeleteRelated($id, false);
  }

  protected function getDeletedMorphIds($id, $relatedTypeId)
  {
    if (empty($id))
      return null;

    $query=new Query();
    return $query->select('id')
                  ->from('rel_activity_morph')
                  ->where(['and', ['related_type_id' => $relatedTypeId, 'activity_id'=>$id], ['and',  ['is not', 'deleted_at', null]]])
                  ->column();
  }

  public function actionAddrelated($id)
  {
    $model=new Activity();
    $model->id=$id;
    $dbModel=Activity::findOne($id);
    // copy db values into new mode
    $model->setAttributes($dbModel->getAttributes());

    list($relatedTypeId, $tableName, $this->keywordLabel)=Yii::$app->appHelper->getRelatedTypeInfo($model->related_type);

    if (Yii::$app->request->isPost)
    {
      // post is for saving?
      if ($this->formSubmit == 'save')
      {
        if (empty($model->idList))
          Yii::$app->session->setFlash('pageError', Yii::t('main', 'SELECT_FROM_SEARCH_RESULTS'));
        else
        {
          $deletedRelations=ActivityMorph::findAll(['id' => $this->getDeletedMorphIds($id, $relatedTypeId)]);
          $this->saveRelatedList($model, $deletedRelations, $relatedTypeId, $tableName);

          return $this->redirect(['view', 'id' => $model->id]);
        }
      }
    }

    $this->excludeIds=$this->getExcludedRelatedIds($model->id, $relatedTypeId);

    list($this->searchResults, $this->tooManyResults)=$this->searchRecordsByName($tableName, $this->keyword, 100, $this->excludeIds);

    return $this->render('add-related-form', ['model' => $model, 'controller' => $this]);
  }
}