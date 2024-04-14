<?php

/** @var yii\web\View $this */

use yii\widgets\Pjax;

$this->title = 'Онлайн-сервис для заметок';
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Онлайн-сервис для заметок</h1>
    </div>

    <div class="body-content">
        <?php if (Yii::$app->user->identity): ?>
            <?php Pjax::begin(['enablePushState' => false]); ?>
                <?= $this->render('//site/_parts/search_notes',compact('searchModel')) ?>
                <?= $this->render('//site/_parts/list_notes',compact('dataProvider', 'pageNum', 'totalCount', 'pageSize')) ?>
            <?php Pjax::end(); ?>
        <?php else: ?>
            <h4 class="text-center">Авторизуйтесь чтобы воспользоваться сервисом</h4>
        <?php endif; ?>
    </div>
</div>
