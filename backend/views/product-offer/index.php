<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductOfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Offers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-offer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Offer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_id',
            'title',
            'title_style',
            'price',
            // 'price_style',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
