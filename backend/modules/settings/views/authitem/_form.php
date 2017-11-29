<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\Usergroup;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\Authitem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authitem-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal']); ?>
    <?= $form->errorSummary($model) ?>

    <?php //echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord) {
        echo $form->field($model, 'controller')->textInput(['maxlength' => true,'placeholder'=>'site']);
    }else{ 
        echo $form->field($model, 'controller')->textInput(['maxlength' => true]);
    }
    ?>

    <?php if ($model->isNewRecord) {
        echo $form->field($model, 'action')->textInput(['maxlength' => true,'placeholder'=>'index']);
    }else{  
        echo $form->field($model, 'action')->textInput(['maxlength' => true]);
    }?>

    <?php //echo $form->field($model, 'unique_item')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'created_at')->textInput() ?>

    <?php //echo $form->field($model, 'postby_id')->textInput() ?>

    <?php //echo $form->field($model, 'is_verified')->textInput() ?>

    <?php //echo $form->field($model, 'verifiedby_id')->textInput() ?>

    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

    <?php //echo $form->field($model, 'is_active')->textInput() ?>


    <div class="form-group">
        <label class="col-md-3">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
