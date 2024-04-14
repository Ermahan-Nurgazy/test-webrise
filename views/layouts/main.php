<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="<?= \yii\helpers\Url::home() ?>" class="navbar-brand">Webrise</a>
            <?php if (Yii::$app->user->identity): ?>
                <div>
                    <span class="text-white mx-3"><?= Yii::$app->user->identity->username ?></span>
                    <a type="button" class="btn btn-light my-2 my-sm-0" href="<?= \yii\helpers\Url::to(['/site/logout']) ?>" data-method="post">Выход</a>
                </div>
            <?php else: ?>
                <?php $authAuthChoice = \yii\authclient\widgets\AuthChoice::begin([
                    'baseAuthUrl' => ['site/auth']
                ]); ?>
                <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <?= $authAuthChoice->clientLink($client,
                        '<span class="fa fa-vk"></span> Авторизация',
                        [
                            'class' => 'btn btn-light',
                        ]) ?>
                <?php endforeach; ?>
                <?php \yii\authclient\widgets\AuthChoice::end(); ?>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Webrise <?= date('Y') ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
