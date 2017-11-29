<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'usergroup_id',
            'username',
            'auth_key',
            //'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'contact_no:ntext',
            // 'remarks:ntext',
            // 'created_at',
            // 'postby_id',
            // 'is_verified',
            // 'verifiedby_id',
            // 'updated_at',
            // 'status',
            // 'is_active',
             [
                'attribute'=>'is_active',
                'filter'=>array("1"=>"Active","0"=>"Inactive"),                
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
