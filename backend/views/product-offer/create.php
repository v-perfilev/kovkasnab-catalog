<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductOffer */

$this->title = 'Create Product Offer';
$this->params['breadcrumbs'][] = ['label' => 'Product Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-offer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
