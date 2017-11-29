<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\Authority */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Authorities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authority-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'usergroup_id',
            'authitem_id',
            'is_access',
            'created_at',
            'postby_id',
            'is_verified',
            'verifiedby_id',
            'updated_at',
            'is_active',
        ],
    ]) ?>

</div>
