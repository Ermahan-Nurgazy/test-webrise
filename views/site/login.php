<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $authAuthChoice = \yii\authclient\widgets\AuthChoice::begin([
        'baseAuthUrl' => ['site/auth']
    ]); ?>
        <div class="row">
            <?php foreach ($authAuthChoice->getClients() as $client): ?>
                <div class="col-1">
                    <?= $authAuthChoice->clientLink($client) ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php \yii\authclient\widgets\AuthChoice::end(); ?>
</div>
