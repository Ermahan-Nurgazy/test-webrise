<?php

use yii\helpers\Html;
?>
<?php $form = \yii\widgets\ActiveForm::begin([
    'action' => ['/site/index'],
    'options' => ['data-pjax' => true]
]) ?>
    <div class="search-notes d-flex justify-content-between mb-5">
        <div class="search-fields">
            <div>
                <?= $form->field($searchModel,'time',[
                    'template' => '{input}',
                    'options' => ['tag' => false]
                ])->hiddenInput() ?>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <?= Html::submitButton( 'Всё',['class' => $searchModel->time == 'all' ? 'btn btn-success' : 'btn btn-outline-success', 'value' => 'all', 'name' => 'NotesSearch[time]']) ?>
                    <?= Html::submitButton('За месяц',['class' => $searchModel->time == 'all' || $searchModel->time == 'month' ? 'btn btn-success' : 'btn btn-outline-success', 'value' => 'month', 'name' => 'NotesSearch[time]']) ?>
                    <?= Html::submitButton('За неделю',['class' => $searchModel->time == 'all' || $searchModel->time == 'week' ? 'btn btn-success' : 'btn btn-outline-success', 'value' => 'week', 'name' => 'NotesSearch[time]']) ?>
                </div>
            </div>
        </div>
        <div class="search-input col-4">
            <div class="d-flex justify-content-between">
                <?= $form->field($searchModel,'searchInput',[
                    'options' => ['tag' => false]
                ])
                    ->textInput([
                        'placeholder' => 'Поиск по заголовку или по тэгу'
                    ])
                    ->label(false) ?>
                <div class="submit">
                    <button type="submit" class="btn btn-secondary">Поиск</button>
                </div>
            </div>
        </div>
        <div class="sort-buttons">
            <?= $form->field($searchModel,'sort',[
                'template' => '{input}',
                'options' => ['tag' => false]
            ])->hiddenInput() ?>
            <?= Html::submitButton( 'Сначала новые',['class' => $searchModel->sort == 3 ? 'btn btn-primary' : 'btn btn-outline-primary', 'value' => 3, 'name' => 'NotesSearch[sort]']) ?>
            <?= Html::submitButton( 'Сначала старые',['class' => $searchModel->sort == 4 ? 'btn btn-primary' : 'btn btn-outline-primary', 'value' => 4, 'name' => 'NotesSearch[sort]']) ?>
        </div>
    </div>
<?php \yii\widgets\ActiveForm::end() ?>


