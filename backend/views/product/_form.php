<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use common\models\ProductCategory;
use common\models\Feature;
use common\models\FeatureValue;
use vova07\imperavi\Widget;

?>

<?php
$this->registerJs(
    '$(document).ready(function(){

            $.pjax.reload( {
                container: $("#product-form-features"),
                history: false,
                type: "POST",
                data: $("#product-form").serialize(),
                url: "refresh-form",
            });

            $("#product-form select").change( function() {
                $.pjax.reload( {
                    container: $("#product-form-features"),
                    history: false,
                    type: "POST",
                    data: $("#product-form").serialize(),
                    url: "refresh-form",
                });
            });
        });'
);
?>

<?php $form = ActiveForm::begin(['id' => 'product-form']); ?>

    <div class="row">

        <div class="col-md-4">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'vendor')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'product_category_id')->dropDownList(ArrayHelper::map(ProductCategory::find()->all(), 'id', 'title')) ?>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <?= $form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'plugins' => [
                'fullscreen',
                'table',
                'fontsize',
                'fontfamily'
            ]
        ]
    ]) ?>

    <br>
    <?= $form->field($model, 'availability')->checkbox([], false) ?>
    <br>

    <div class="panel panel-default">
        <div class="panel-body">

        <h4>Характеристики</h4>
        <br>

        <?php Pjax::begin(['id' => 'product-form-features']); ?>
            <?php foreach(Feature::find()->where(['product_category_id' => $model->product_category_id])->all() as $feature) {
                $a = ['-1' => 'не выбран'];
                $b = ArrayHelper::map(FeatureValue::find()->where(['feature_id' => $feature->id])->all(), 'id', 'value');
                $result = ArrayHelper::merge($a, $b);
                ?>

                <?= $form->field($model, 'features['. $feature->id .'][value]')->label($feature->title)->radioList($result); ?>

            <?php } ?>
        <?php Pjax::end(); ?>

        </div>
    </div>


    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>