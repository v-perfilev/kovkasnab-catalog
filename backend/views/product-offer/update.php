<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductOffer */

$this->title = 'Update Product Offer: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-offer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
