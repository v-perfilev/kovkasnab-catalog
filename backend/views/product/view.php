<?php

use yii\helpers\Html;
use yii\helpers\url;
use yii\widgets\DetailView;

$this->title = $modelProduct->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->registerJs(
    '$("document").ready(function(){
        $("#product-image-form").on("pjax:end", function(event) {
            $.pjax.reload({
                container:"#product-image-gridview",
                timeout: 5000
            });
        });
    });'
);?>

<p>
    <?= Html::a('Изменить', ['update', 'id' => $modelProduct->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $modelProduct->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы действительно хотите удалить этот товар?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $modelProduct,
    'attributes' => [
        'id',
        'title',
        [
            'attribute' => 'product_category_id',
            'value' => $modelProduct->productCategory->title,
        ],
        'slug',
        'vendor',
        'text',
        'price',
        'size',
        'weight',
        'availability',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ],
]) ?>

<?php if (!empty($productFeatures)) { ?>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Характеристика</th>
                    <th>Значение</th>
                </tr>
                <?php foreach($productFeatures as $f) { ?>
                    <tr>
                        <td><?= $f[0] ?></td>
                        <td><?= $f[1] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
<?php } ?>


<div class="panel panel-default">
    <div class="panel-body">

        <?= $this->render('view_image_form', [
            'modelImage' => $modelImage,
            'modelProduct' => $modelProduct,
        ]); ?>

        <br>

        <?= $this->render('view_image_gridview', [
            'dataProviderImage' => $dataProviderImage,
        ]); ?>

    </div>
</div>


<div class="panel panel-default">
    <div class="panel-body">

        <?= $this->render('view_offer', [
            'modelProduct' => $modelProduct,
            'modelOffer' => $modelOffer,
        ]); ?>

    </div>
</div>