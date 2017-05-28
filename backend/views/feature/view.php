<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\grid\GridView;



/* @var $this yii\web\View */
/* @var $model common\models\Feature */

$this->title = $modelFeature->title;
$this->params['breadcrumbs'][] = ['label' => 'Характеристики' , 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$this->registerJs(
    '$("document").ready(function(){
        $("#feature-value-form").on("pjax:end", function() {
            $.pjax.reload({container:"#feature-value-gridview"});
        });
    });'
);
?>

<p>
    <?= Html::a('Изменить', ['update', 'id' => $modelFeature->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $modelFeature->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы действительно хотите удалить эту характеристику?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $modelFeature,
    'attributes' => [
        'id',
        'title',
        [
            'label' => 'Категория',
            'value' => $modelFeature->productCategory->title,
        ],
    ],
]) ?>

    <div class="panel panel-default">
        <div class="panel-body">

            <?= $this->render('view_form', [
                'modelFeature' => $modelFeature,
                'modelValue' => $modelValue,
            ]); ?>

            <br>

            <?= $this->render('view_gridview', [
                'dataProviderValue' => $dataProviderValue,
            ]); ?>

        </div>
    </div>

