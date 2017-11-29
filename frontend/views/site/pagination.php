<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Pagination';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <code><?= __FILE__ ?></code>
<?php
foreach ($models as $model) {
?>	
<h3><?= $model->title; ?></h3>
<?php
}

// display pagination
echo LinkPager::widget([
    'pagination' => $pages,
]);
?>
</div>
