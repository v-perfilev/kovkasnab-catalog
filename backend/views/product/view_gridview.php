<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>

<?php Pjax::begin(['id' => 'product-image-gridview', 'enablePushState' => false, 'timeout' => 5000]); ?>
<?= GridView::widget([
    'dataProvider' => $dataProviderImage,
    'columns' => [

        [
            'attribute'=>'id',
            'headerOptions' => ['width' => '50'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'attribute'=>'image_url',
            'contentOptions' =>['style'=>'vertical-align:middle;'],
        ],

        [
            'label'=>'Изображение',
            'format'=>'raw',
            'value'=>function($data){
                if( isset($data->image_url) )
                    return Html::img(Url::to('/uploads/product-images/thumb_' . $data->image_url),['style'=>'width:150px;']);
                else
                    return "Отсутствует";
            },
            'headerOptions' => ['width' => '200'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'attribute'=>'order',
            'headerOptions' => ['width' => '150'],
            'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{ajax-up-image}&nbsp;&nbsp;&nbsp;&nbsp;{ajax-down-image}&nbsp;&nbsp;&nbsp;&nbsp;{ajax-delete-image}',
            'buttons' => [
                'ajax-up-image' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',$url);
                },
                'ajax-down-image' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',$url);
                },
                'ajax-delete-image' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url);
                },

            ],
            'headerOptions' => ['width' => '150'],
            'contentOptions' =>['style'=>'font-size: 20pt; vertical-align:middle;'],
        ],
    ],

]); ?>
<?php Pjax::end(); ?>
