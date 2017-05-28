<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

?>
<div class="site-error container">

    <div class="space-area"></div>

    <?php if($exception->statusCode == '404') { $this->title = "Ошибка 404"; $message = "Страница не найдена"; ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <? } else { ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <? } ?>

    <div class="space-area"></div>

    <div class="alert alert-danger row horizontal-center">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <div class="space-area"></div>

    <div class="horizontal-center">
        <b><a href="/">Перейти на главную страницу</a></b>
    </div>

</div>
