<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use kartik\select2\Select2;
use backend\modules\settings\models\Authority;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\settings\models\AuthoritySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authorities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authority-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Authority', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'usergroup_id',
            /*[
                        'attribute' => 'usergroup_id',
                        'value' => function($model){
                                //  @var $model app\models\Object 
                                return $model->getUsergroup()[$model->usergroup_id];
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'usergroup_id',
                            'data' => Authority::getUsergroup(),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'hideSearch' => true,
                            'options' => [
                                'placeholder' => 'Select Usergroup...',
                            ]
                        ]),
                        'contentOptions' => [
                                'style' => 'vertical-align: middle;'
                        ]
                ],*/
            'authitem_id',
            'is_access',
            'created_at',
            // 'postby_id',
            // 'is_verified',
            // 'verifiedby_id',
            // 'updated_at',
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
