<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Feature */

?>


<?php Pjax::begin([ 'enablePushState' => false, 'id' => 'feature-value-gridview']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderValue,
        'columns' => [

            [
                'attribute'=>'id',
                'headerOptions' => ['width' => '50'],
                'contentOptions' =>['style'=>'text-align: center; vertical-align:middle;'],
            ],

            [
                'attribute'=>'value',
                'contentOptions' =>['style'=>'vertical-align:middle;'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete-value}',
                'buttons' => [
                    'delete-value' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url);
                    },
                ],
                'headerOptions' => ['width' => '60'],
                'contentOptions' =>['style'=>'font-size: 20pt; vertical-align:middle;']
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>