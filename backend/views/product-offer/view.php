<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductOffer */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-offer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_id',
            'title',
            'title_style',
            'price',
            'price_style',
        ],
    ]) ?>

</div>
