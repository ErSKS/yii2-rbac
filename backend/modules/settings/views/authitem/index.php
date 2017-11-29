<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\settings\models\AuthitemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\bootstrap\Modal;
Modal::begin([
    'header' => '<h2>Hello world</h2>',
    'toggleButton' => ['label' => 'click me'],
]);

echo 'Say hello...';

Modal::end();

$this->title = 'Authitems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitem-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Authitem', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'group_name',
            'controller',
            'action',            
            // 'unique_item',
            // 'remarks:ntext',
            // 'created_at',
            // 'postby_id',
            // 'is_verified',
            [
             'attribute'=>'is_verified',             
             'format'=>'raw',
             'filter'=> array("1"=>"Yes","0"=>"No"),
             'value' => function($model, $key, $index, $column){ 
                return $model->is_verified == 1 ? 'Yes' : 'No';
                },
            ],
            // 'verifiedby_id',
            // 'updated_at',
            // 'is_active',
            [
             'attribute'=>'is_active',
             'label'=>'Status',
             'format'=>'raw',
             'filter'=> array("1"=>"Active","0"=>"Inactive"),
             'value' => function($model, $key, $index, $column){ 
                return $model->is_active == 1 ? 'Active' : 'Inactive';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
