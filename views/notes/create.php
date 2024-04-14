<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Notes $model */

$this->title = 'Добавить заметку';
?>
<div class="notes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
