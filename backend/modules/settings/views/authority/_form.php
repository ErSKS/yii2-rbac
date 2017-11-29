<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\modules\settings\models\Usergroup;
use backend\modules\settings\models\Authitem;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\Authority */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authority-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal']); ?>
    <?= $form->errorSummary($model) ?>

    <?php //echo $form->field($model, 'usergroup_id')->textInput() ?>
    <?= $form->field($model, 'usergroup_id')
    ->dropDownList(ArrayHelper::map(Usergroup::find()->all(), 'id', 'title'),
    ['prompt'=>'Select a User Group']);?>
   
    <?= $form->field($model, 'authitem_id')
    ->dropDownList(ArrayHelper::map(Authitem::find()->all(), 'id', 'title'),
    ['prompt'=>'Select an Item']);?>

    <?php //echo $form->field($model, 'is_access')->textInput();
        echo $form->field($model, 'is_access')->widget(SwitchInput::classname(), [
            'type' => SwitchInput::CHECKBOX
        ]);
     ?>

    <?php //echo $form->field($model, 'created_at')->textInput() ?>

    <?php //echo $form->field($model, 'postby_id')->textInput() ?>

    <?php //echo $form->field($model, 'is_verified')->textInput() ?>

    <?php //echo $form->field($model, 'verifiedby_id')->textInput() ?>

    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

    <?php //echo $form->field($model, 'is_active')->textInput() ?>

    <div class="form-group">
        <label class="control-label col-sm-3">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
