<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\Usergroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usergroup-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'created_at')->textInput() ?>

    <?php //echo $form->field($model, 'postby_id')->textInput() ?>

    <?php //echo $form->field($model, 'is_verified')->textInput() ?>

    <?php //echo $form->field($model, 'verifiedby_id')->textInput() ?>

    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

    <?php //echo $form->field($model, 'is_active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
