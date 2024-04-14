<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Notes $model */

$this->title = 'Редактировать заметку: ' . $model->title;
?>
<div class="notes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
