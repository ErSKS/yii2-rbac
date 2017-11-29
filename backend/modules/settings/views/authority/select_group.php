<?php
//echo "Nepal";

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\modules\settings\models\Usergroup;
use backend\modules\settings\models\Authitem;

use kartik\switchinput\SwitchInput;


$this->title = 'Rule Book';
$this->params['breadcrumbs'][] = ['label' => 'Rule Book', 'url' => ['/authority/select_group']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authority-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="authority-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal']); ?>
    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'usergroup_id')
    ->dropDownList(ArrayHelper::map(Usergroup::find()->all(), 'id', 'title'),
    ['prompt'=>'Select a User Group']);?>   

    <div class="form-group">
        <label class="control-label col-sm-3">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? 'Proceed' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
