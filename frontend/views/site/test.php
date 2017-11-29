<?php

/* @var $this yii\web\View */

$this->title = 'This is test page';
?>
<div class="site-index">

    <div class="jumbotron">
        <img src="<?= Yii::$app->params['commonPath'];?>/uploads/images/khce_front.jpg" width="100%">
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>BE Civil</h2>

                <p>This college offers Bachelor's level courses in Civil Engineering since its establishments with well equipped laboratories and experienced faculties.</p>

                <p><a class="btn btn-default" href="#">Read More &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>BE Computer</h2>

                <p>Computer Engineering is the recently launched program in our college. This field of engineering not only focuses on how computer systems themselves work, but also how they integrate into the larger picture.</p>

                <p><a class="btn btn-default" href="<?= Yii::$app->urlManager->createUrl('site/about');?>">Read More &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>BE Electrical</h2>

                <p>Electrical engineering is one of the newer branches of engineering, and dates back to the late 19th century. It is the branch of engineering that deals with the technology of electricity.</p>

                <p><a class="btn btn-default" href="#">Read More &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
