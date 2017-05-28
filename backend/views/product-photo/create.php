<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductPhoto */

$this->title = 'Create Product Photo';
$this->params['breadcrumbs'][] = ['label' => 'Product Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
