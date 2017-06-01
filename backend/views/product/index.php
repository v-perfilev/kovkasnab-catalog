<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\ProductCategory;

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php Pjax::begin([ 'enablePushState' => false, 'id' => 'productgridview']); ?>
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
            'attribute'=>'vendor',
            'contentOptions' =>['style'=>'vertical-align:middle;'],
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
            'attribute'=>'price',
            'headerOptions' => ['width' => '100'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'attribute'=>'weight',
            'headerOptions' => ['width' => '100'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'attribute'=>'availability',
            'headerOptions' => ['width' => '100'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'attribute'=>'product_offer',
            'label' => 'Спецпредложение',
            'value'=>function($data){
                if (!empty($data->productOffer) )
                    return 'есть';
                else
                    return '';
            },
            'headerOptions' => ['width' => '100'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}&nbsp;&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;&nbsp;{delete}',
            'headerOptions' => ['width' => '150'],
            'contentOptions' =>['style'=>'font-size: 20pt; vertical-align:middle;'],
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
