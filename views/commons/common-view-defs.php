<?php
use yii\db\ActiveRecord;
use app\models\CrmModel;
use yii\helpers\Html;

// @formatter:off
if ($pageError=Yii::$app->session->getFlash('pageError'))
{
  $errorList='';
  if ($pageErrors=Yii::$app->session->getFlash('pageErrors'))
  {
    foreach ($pageErrors as $key=>$errors)
      $errorList.=implode('<li>', $errors);

    $errorList='<br><ul><li>'.$errorList.'</ul>';
  }

  echo <<<EOT
  <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <span class="glyphicon glyphicon-remove-sign"></span>&nbsp;&nbsp; $pageError
    $errorList
  </div>
EOT;
}

if ($pageWarning=Yii::$app->session->getFlash('pageWarning'))
{
  echo <<<EOT
  <div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp; $pageWarning
  </div>
EOT;
}

if ($pageSuccess=Yii::$app->session->getFlash('pageSuccess'))
{
  echo <<<EOT
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp; $pageSuccess
  </div>
EOT;
}

// ************************************************************************************************************************************

$ttSalut=['template'=>'{input}',
          'options'=> ['tag'=>'span', 'class'=>'col-xs-2'],
];

$tt1ColIn=['template'    =>'{label}<div class="col-xs-7 col-sm-10">{input}</div>{error}{hint}',
           'options'     => ['tag'=>'div', 'class'=>'col-sm-12'],
           'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap  col-xs-5 col-sm-2'],
           'inputOptions'=> ['class'=>'form-control'],
];

$tt1ColInSm=['template'    =>'{label}<div class="col-xs-6 col-sm-7">{input}</div>{error}{hint}',
             'options'     => ['tag'=>'div', 'class'=>'col-sm-12'],
             'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-6 col-sm-5'],
             'inputOptions'=> ['class'=>'form-control'],
];

$tt1ColInOwner=['template'    =>'{label}<div class="col-xs-3">{input}</div>{error}{hint}',
                'options'     => ['tag'=>'div', 'class'=>'row'],
                'labelOptions'=> ['class'=>'control-label text-nowrap  col-xs-6'],
                'inputOptions'=> ['class'=>'form-control'],
];

$tt1ColCbox=['template'    =>'{label}{input}{hint}{error}',
             'options'     => ['tag'=>'div', 'class'=>'col-xs-5 col-sm-4 col-md-3 col-lg-2 text-nowrap'],
             'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-11'],
             'inputOptions'=> ['class'=>'form-control'],
];

$tt2ColIn=['template'    =>'{label}<div class="col-xs-7 col-sm-8">{input}</div>{error}{hint}',
           'options'     => ['tag'=>'div', 'class'=>'col-sm-6'],
           'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-5 col-sm-4'],
           'inputOptions'=> ['class'=>'form-control'],
];

$tt2ColCBox=['template'    =>'{label}<div class="col-xs-7 col-sm-7 form-field-height-fix">{input}</div>{error}{hint}',
             'options'     => ['tag'=>'div', 'class'=>'col-sm-6'],
             'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-5 col-sm-4'],
             'inputOptions'=> ['class'=>'form-control'],
];

$tt3ColIn=['template'    =>'{label}<div class="col-xs-8">{input}</div>{error}{hint}',
           'options'     => ['tag'=>'div', 'class'=>'col-sm-4'],
           'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-4'],
           'inputOptions'=> ['class'=>'form-control'],
];

// odd ducks
$dropSalut='';
$ttNameSal=[];
$tt2ColAcc=[];
$tt2ColContName=[];

if (isset($form) && isset($model) && ($model instanceof CrmModel || $model instanceof ActiveRecord))
{
  if (in_array($model->tableName(), ['leads', 'contacts']))
  {
    $dropSalut=$form->field($model, 'salutation_id', $ttSalut)->dropDownList(Yii::$app->appHelper->getLookupData('lkp_salutation'));

    $ttNameSal=['template'    => '{label}'.$dropSalut.'<div class="col-xs-5 col-sm-6">{input}</div>{error}{hint}',
                'options'     => ['tag'=>'div', 'class'=>'col-sm-6'],
                'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-5 col-sm-4'],
                'inputOptions'=> ['class'=>'form-control'],
    ];
  }

  // contact only fields
  if ($model->tableName()=='contacts')
  {
    // not used; keeping for historical reasons
    $tt2ColAcc=['template'    =>'{label}{input}<div id="account_name" class="col-xs-6" style="margin-top:3px; font-weight:bold;">'.Html::encode($model->account ? $model->account->name : '').'</div>
                                   <div class="col-xs-2" style="margin-top:3px;"> [<a href="javascript:void(0)" onclick="showChangeAccountWindow('.$model->account_id.')">'.Yii::t('main', 'Change').'</a>]</div>{error}{hint}',
                'options'     => ['tag'=>'div', 'class'=>'col-sm-6'],
                'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-4'],
                'inputOptions'=> ['class'=>'form-control'],
    ];

    $tt1ColCat3=['template'    =>'{label}<div class="col-xs-5 col-sm-3">{input}</div>'.
                                 '<div class="col-xs-5 col-sm-3">'.Html::dropDownList('Contact[category2_id]', $model->category2_id, Yii::$app->appHelper->getLookupData('lkp_contact_category'), ['id'=>'contact-category2_id', 'class'=>'form-control', 'onChange'=>'handleGroupDropdownChange(this)']).'</div>'.
                                 '<div class="col-xs-5 col-sm-3">'.Html::dropDownList('Contact[category3_id]', $model->category3_id, Yii::$app->appHelper->getLookupData('lkp_contact_category'), ['id'=>'contact-category3_id', 'class'=>'form-control', 'onChange'=>'handleGroupDropdownChange(this)']).'</div>'.
                                 '{error}{hint}',
                 'options'     => ['tag'=>'div', 'class'=>'col-sm-12'],
                 'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-5 col-sm-2'],
                 'inputOptions'=> ['class'=>'form-control', 'onChange'=>'handleGroupDropdownChange(this)'],
    ];

    $tt1ColAcc3=['template'    =>'{label}{input}
                                    <input type="hidden" id="contact-account2_id" name="Contact[account2_id]" value="'.$model->account2_id.'">
                                    <input type="hidden" id="contact-account3_id" name="Contact[account3_id]" value="'.$model->account3_id.'">'.
                                 '<div class="col-xs-5 col-sm-3 mul-val-att1"><span id="account_name">'.Html::encode($model->account ? $model->account->name : '').'</span>&nbsp;&nbsp;<sup>[<a href="javascript:void(0)" onclick="showChangeAccountWindow('.$model->account_id.', 1)">'.Yii::t('main', 'Change').'</a>]</sup></div>'.
                                 '<div class="col-xs-5 col-sm-3 mul-val-att2"><span id="account2_name">'.Html::encode($model->account2 ? $model->account2->name : '').'</span>&nbsp;&nbsp;<sup>[<a href="javascript:void(0)" onclick="showChangeAccountWindow('.$model->account2_id.', 2)">'.Yii::t('main', 'Change').'</a>]</sup></div>'.
                                 '<div class="col-xs-5 col-sm-3 mul-val-att3"><span id="account3_name">'.Html::encode($model->account3 ? $model->account3->name : '').'</span>&nbsp;&nbsp;<sup>[<a href="javascript:void(0)" onclick="showChangeAccountWindow('.$model->account3_id.', 3)">'.Yii::t('main', 'Change').'</a>]</sup></div>'.
                                 '{error}{hint}',
                 'options'     => ['tag'=>'div', 'class'=>'col-sm-12'],
                 'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-5 col-sm-2'],
                 'inputOptions'=> ['class'=>'form-control'],
    ];

    $tt1ColTtl3=['template'    =>'{label}<div class="col-xs-5 col-sm-3">{input}</div>'.
                                 '<div class="col-xs-5 col-sm-3"><input type="text" id="Contact[title2]" name="Contact[title2]" class="form-control" value="'.Html::encode($model->title2).'" /></div>'.
                                 '<div class="col-xs-5 col-sm-3"><input type="text" id="Contact[title3]" name="Contact[title3]" class="form-control" value="'.Html::encode($model->title3).'"/></div>'.
                                 '{error}{hint}',
                 'options'     => ['tag'=>'div', 'class'=>'col-sm-12'],
                 'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-5 col-sm-2'],
                 'inputOptions'=> ['class'=>'form-control'],
    ];
  }

  // opportunity only fields
  if (in_array($model->tableName(), ['opportunities']))
  {
    $tt2ColContName=['template'    =>'{label}{input}<div id="contact_name" class="col-xs-5 col-sm-6 form-field-height-fix"> Html::encode($model->contact ? $model->contact->first_name. .$model->contact->last_name : ) </div>
                                      <div class="col-xs-2 col-sm-1 form-field-height-fix"> [<a href="javascript:void(0)" onclick="showChangeContactWindow( $model->contact_id )">'.Yii::t('main', 'Change').'</a>]</div>{error}{hint}',
                     'options'     => ['tag'=>'div', 'class'=>'col-sm-6'],
                     'labelOptions'=> ['class'=>'control-label ui-state-default text-nowrap col-xs-5 col-sm-4'],
                     'inputOptions'=> ['class'=>'form-control'],
    ];
  }
}
// @formatter:on
