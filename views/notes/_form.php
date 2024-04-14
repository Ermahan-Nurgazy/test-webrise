<?php

use dosamigos\selectize\SelectizeTextInput;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Notes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tagNames')->widget(SelectizeTextInput::className(), [
        'loadUrl' => ['/notes/notes-tags'],
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'class' => 'form-control',
            'plugins' => ['remove_button' => ['title' => 'Удалить']],
            'valueField' => 'name',
            'labelField' => 'name',
            'searchField' => ['name'],
            'create' => true,
            'createFilter' => new JsExpression("function(input) { return input.length >= 1 && input.length <= 40;}"),
            'maxItems' => 4,
            'render' => [
                'option_create' => new JsExpression("function(data, escape) { return '<div class=\"create\">Добавить <strong>' + escape(data.input) + '</strong>&hellip;</div>'; }")
            ]
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
