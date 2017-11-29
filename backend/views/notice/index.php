<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use backend\models\Department;
/* @var $this yii\web\View */
/* @var $searchModel common\models\NoticeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notices';
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->session->setFlash('info',"Data is sorted in Reverse Order !");

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'name',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'headerOptions'=>['class'=>'kv-sticky-column'],
        'contentOptions'=>['class'=>'kv-sticky-column'],
        'editableOptions'=>['header'=>'Name', 'size'=>'md']
    ],
    [
        'attribute'=>'color',
        'value'=>function ($model, $key, $index, $widget) {
            return "<span class='badge' style='background-color: {$model->color}'> </span>  <code>" . 
                $model->color . '</code>';
        },
        'filterType'=>GridView::FILTER_COLOR,
        'vAlign'=>'middle',
        'format'=>'raw',
        'width'=>'150px',
        'noWrap'=>true
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'status', 
        'vAlign'=>'middle',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => true,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { return '#'; },
        // 'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
        // 'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
        // 'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'], 
    ],
    ['class' => 'kartik\grid\CheckboxColumn']
];
?>
<div class="notice-index">

    <!-- <h1><?php //echo Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?php //echo Html::a('Create Notice', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            //'summary',
            //'description:ntext',
            //'dept_id',
            [
            'attribute'=>'dept_id', 
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) { 
                return $model->dept->title;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Department::find()->orderBy('id')->asArray()->all(), 'id', 'title'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Any Department'],
            'group'=>true,  // enable grouping
        ],
            // 'sem_id',
            // 'image',
            // 'expiry_date',
            // 'order',
            // 'priority',
            // 'remarks:ntext',
            // 'created_at',
            // 'postby_id',
            // 'is_verified',
            // 'verifiedby_id',
            // 'updated_at',
            'hits',
            'is_active',           
            ['class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => ['onclick' => 'js:addItems(this.value, this.checked)']],
            ['class' => 'yii\grid\ActionColumn'],
            ],
        'beforeHeader'=>[
        // [
        //     'columns'=>[
        //         ['content'=>'Header Before 1', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
        //         ['content'=>'Header Before 2', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
        //         ['content'=>'Header Before 3', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
        //     ],
        //     'options'=>['class'=>'skip-export'] // remove this row from export
        // ]
    ],
    'toolbar' =>  [
        // ['content'=>
        //     Html::button('&lt;i class="glyphicon glyphicon-plus">&lt;/i>', ['type'=>'button', 'title'=>Yii::t('kvgrid', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
        //     Html::a('&lt;i class="glyphicon glyphicon-repeat">&lt;/i>', ['grid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
        // ],
    ['content'=>
        // Html::button('&lt;i class="glyphicon glyphicon-plus">&lt;/i>', ['type'=>'button', 'title'=>Yii::t('app', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
        Html::a('+', ['create'], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>Yii::t('app', 'Add Notice')])
    ],
        '{export}',
        '{toggleData}'
    ],
    'pjax' => true,
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'resizableColumns'=>true,
    'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
    'hover' => true,
    'floatHeader' => false,
    // 'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
    // 'showPageSummary' => true,
    /*'panel' => [
        'type' => GridView::TYPE_INFO
    ],*/
    'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th"></i> Notices</h3>',
        'type'=>'info',
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Notice', ['create'], ['class' => 'btn btn-success']),
        'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        'footer'=>false
    ],
    ]); ?>
<?php Pjax::end(); ?></div>
