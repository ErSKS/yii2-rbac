<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\settings\models\UsergroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usergroups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usergroup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Usergroup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'detail:ntext',
            'remarks:ntext',
            'created_at',
            // 'postby_id',
            // 'is_verified',
            // 'verifiedby_id',
             'updated_at',
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
