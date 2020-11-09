<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
<base href = "/"> 
<title><?= Html::encode($this->title) ?></title>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php $this->registerCsrfMetaTags() ?>
<link rel="icon" type="image/png" href="web/images/favicon.png" />
<?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?> 
<?= $this->render('//layouts/includ/header') ?>
<?= $content ?>
<?= $this->render('//layouts/includ/footer') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
