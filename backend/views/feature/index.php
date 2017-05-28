<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\ProductCategory;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FeatureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Характеристики';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [

        [
            'attribute'=>'id',
            'headerOptions' => ['width' => '50'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'attribute'=>'title',
            'contentOptions' =>['style'=>'vertical-align:middle;'],
        ],

        [
            'attribute'=>'product_category_id',
            'label' => 'Категория',
            'filter' => ArrayHelper::map(ProductCategory::find()->all(), 'id', 'title'),
            'value'=>function($data){
                return $data->productCategory->title;
            },
            'contentOptions' =>['style'=>'vertical-align:middle;'],
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}&nbsp;&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;&nbsp;{delete}',
            'headerOptions' => ['width' => '150'],
            'contentOptions' =>['style'=>'font-size: 20pt; vertical-align:middle;'],
        ],
    ],
]); ?>
