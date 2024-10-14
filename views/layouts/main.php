<?php

/** @var yii\web\View $this */
/** @var string $content */



use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

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
    <link rel="stylesheet" href="<?= Yii::getAlias('@web/css/site.css') ?>">
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
           
            <a class="navbar-brand" href="<?= Yii::getAlias('@web') ?>">TechLead</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['article/index']) ?>">Articles</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['site/signup']) ?>">Sign Up</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>">Login</a></li>

    <?php if (!Yii::$app->user->isGuest): ?>
    <li class="nav-item">
        <?= Html::a('Logout', ['site/logout'], [
            'class' => 'nav-link',
            'data-method' => 'post', // This ensures the request is a POST
            'data-confirm' => 'Are you sure you want to logout?', // Optional confirmation
        ]) ?>
    </li>
<?php endif; ?>

</ul>






            </div>
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
            <div class="col-md-6 text-center text-md-start">© Copyright. TechLead Articles. All rights Reserved <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"> <!-- <?= Yii::powered() ?></div>  -->
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
