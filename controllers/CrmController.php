<?php
namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;

class CrmController extends Controller
{
  public $keyword;
  public $formSubmit;
  public $keywordLabel;
  public $searchResults=null;
  public $tooManyResults=false;
  public $excludeIds=null;
  protected $className=null;
  protected $classNameFull=null;

  public function init()
  {
    if (Yii::$app->request->isGet)
    {
      $this->keyword=Yii::$app->request->get('keyword', '');
    }
    else
    if (Yii::$app->request->isPost)
    {
      $this->keyword=Yii::$app->request->post('keyword', '');
      $this->formSubmit=Yii::$app->request->post('formSubmit', '');
    }

    parent::init();
  }

  // TODO : str_ireplace instead of str_replace?
  public function modelClassNameFull()
  {
    return $this->classNameFull ? $this->classNameFull : ($this->classNameFull=str_replace(['Controller', 'controllers'], ['', 'models'], get_called_class()));
  }

  public function modelClassName()
  {
    return $this->className ? $this->className : ($this->className=str_replace(['app\\controllers\\', 'Controller'], ['', ''], get_called_class()));
  }

  /**
   * Finds the ModelName model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   *
   * @param string $id
   * @return ModelName the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    $modelClass=$this->modelClassNameFull();
    $model=$modelClass::findOne($id);

    if ($model === null)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'Record does not exist.'));
      $this->redirect(['index'])->send();
      exit();
    }

    if (Yii::$app->user->can('Update '.$model->modelClassName(), [$model])==false)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'UNAUTHORIZED_TO_ACCESS'));
      $this->redirect(['index'])->send();
      exit();
    }

    if ($model->deleted_at !== NULL)
    {
      Yii::$app->session->setFlash('pageWarning', Yii::t('main', 'Record was deleted before.') . $model->deleted_at);

      if (Yii::$app->user->can('Manager'))
        return $model;
      else
      {
        return $this->redirect(['index'])->send();
        exit();
      }
    }

    if (isset($model->picture) && empty($model->picture))
      $model->picture='blank.jpg';

    return $model;
  }

  /**
   * Displays a single ModelName model.
   *
   * @param string $id
   * @return mixed
   */
  public function actionView($id)
  {
    $model=$this->findModel($id);

    /*
    if (isset($model->website) && !empty($model->website) && (strpos($model->website, 'http://') === false && strpos($model->website, 'https://') === false))
      $model->website='http://' . $model->website;
    */

    return $this->render('view', ['model' => $model]);
  }

  public function actionEditowner($id)
  {
    $model=$this->findModel($id);

    if ($model->modelClassName()!='Lead' && Yii::$app->user->can('Update ' . $this->modelClassName(), [$model]) == false)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'UNAUTHORIZED_TO_MODIFY'));
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('../commons/change-owner', ['model' => $model]);
  }

  /**
   * Updates an existing ModelType model.
   * If update is successful, the browser will be redirected to the 'view' page.
   *
   * @param string $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    $model=$this->findModel($id);

    if (Yii::$app->user->can('Update ' . $this->modelClassName(), [$model]) == false)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'UNAUTHORIZED_TO_MODIFY'));
      return $this->redirect(['view', 'id' => $model->id]);
    }

    if ($model->load(Yii::$app->request->post()))
    {
      if ($model->save())
      {
        $model->savePicture();

        return $this->redirect(['view', 'id' => $model->id]);
      }
    }

    return $this->render('update', ['model' => $model]);
  }

  /**
   * Deletes an existing ModelType model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   *
   * @param string $id
   * @return mixed
   */
  public function actionDelete($id)
  {
    $model=$this->findModel($id);

    if ($model->modelClassName()!='Lead' && Yii::$app->user->can('Delete ' . $this->modelClassName(), [$model]) == false)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'UNAUTHORIZED_TO_MODIFY'));
      return $this->redirect(['view', 'id' => $model->id]);
    }

    $model->deleted_at=date('Y-m-d H:i:s');

    if ($model->save())
    {
      Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'DELETE_SUCCEEDED'));

      return $this->redirect(['index']);
    }
    else
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'DELETE_FAILED'));

      return $this->redirect(['view', 'id' => $model->id]);
    }
  }

  public function actionSaveowner($id)
  {
    $model=$this->findModel($id);

    if ($model->modelClassName()!='Lead' && Yii::$app->user->can('Update ' . $this->modelClassName(), [$model]) == false)
    {
      Yii::$app->session->setFlash('pageError', Yii::t('main', 'UNAUTHORIZED_TO_MODIFY'));
      return $this->redirect(['view', 'id' => $model->id]);
    }

    if ($model->load(Yii::$app->request->post()))
    {
      if ($model->save())
        Yii::$app->session->setFlash('pageSuccess', Yii::t('main', 'OWNER_UPDATE_SUCCEEDED'));
      else
      {
        Yii::$app->session->setFlash('pageError', Yii::t('main', 'OWNER_UPDATE_FAILED'));
        Yii::$app->session->setFlash('pageErrors', $model->errors);
      }

      return $this->redirect(['view', 'id' => $model->id]);
    }
    else
      return $this->render('update', ['model' => $model]);
  }

  public function searchRecordsByName($pTable, $pName, $pLimit=25, $pExcludeIds=null)
  {
    if (empty($pName))
      return [null, false];

    $startWithLetter=Yii::$app->request->post('startWithLetter', 0);

    $pName=trim(preg_replace("/[^ A-z_-]/", '', $pName));

    $pLimit=$pLimit ? intVal($pLimit) + 1 : 26;

    // first and last name?
    $name=explode(' ', $pName);
    $first = $name[0];
    $last = count($name)==1 ? $first : trim(str_replace($first, '', $pName));

    $first=$startWithLetter ? $first.'%' : '%'.$first.'%';
    $last=$startWithLetter ? $last.'%' : '%'.$last.'%';

    $query=new Query();
    switch ($pTable)
    {
      case 'accounts':
      case 'opportunities':
        $query->select(['id', 'name'])
          ->from($pTable)
          ->where(['like', 'name', $first, false]);
      break;
      default: // contacts
        $query->select(['id', 'concat(first_name, " ", last_name) as name'])
          ->from($pTable)
          ->where(['or', ['like', 'first_name', $first, false], ['like', 'last_name', $last, false]]);
    }

    // make sure excluded ids are in correct format
    $pExcludeIds=$pExcludeIds ? (is_array($pExcludeIds) ? array_values($pExcludeIds) : [$pExcludeIds]) : [];
    if (count($pExcludeIds))
      $query->andWhere(['not in', 'id', $pExcludeIds]);

    $results=$query->andWhere('deleted_at is null')->orderBy('name')->limit($pLimit)->all();

    $tooManyFound=false;
    if (count($results) == $pLimit)
    {
      $tooManyFound=true;
      unset($results[$pLimit - 1]);
    }

    return [$results, $tooManyFound];
  }

  public function searchAccountsByName($pName, $pLimit=25, $pExcludeIds=null)
  {
    return $this->searchRecordsByName('accounts', $pName, $pLimit, $pExcludeIds);
  }

  public function searchContactsByName($pName, $pLimit=25, $pExcludeIds=null)
  {
    return $this->searchRecordsByName('contacts', $pName, $pLimit, $pExcludeIds);
  }

  public function searchOpportunitiesByName($pName, $pLimit=25, $pExcludeIds=null)
  {
    return $this->searchRecordsByName('opportunities', $pName, $pLimit, $pExcludeIds);
  }

  public function actionShowupdatehistory($id)
  {
    $model=$this->findModel($id);
    $updates=$model->getUpdateHistory();

    return $this->render('../commons/update-history', ['model' => $model, 'updates' => $updates]);
  }
}