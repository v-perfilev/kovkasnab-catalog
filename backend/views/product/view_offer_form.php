<?php

use yii\helpers\Html;
use yii\helpers\url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>


<?php Pjax::begin(['id' => 'product-offer-form', 'enablePushState' => false, 'timeout' => 5000]); ?>
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['ajax-change-offer', 'id' => $modelProduct->id]),
        'options' => ['data-pjax' => true],
    ]); ?>

        <?= $form->field($modelNewOffer, 'product_id')->hiddenInput(['value' => $modelProduct->id])->label(false); ?>

        <div class="row">

            <div class="col-md-3">
                <?= $form->field($modelNewOffer, 'title')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($modelNewOffer, 'title_style')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($modelNewOffer, 'price')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($modelNewOffer, 'price_style')->textInput(['maxlength' => true]) ?>
            </div>

        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Очистить', ['ajax-clear-offer', 'id' => $modelProduct->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить спецпредложение?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>

    <?php ActiveForm::end(); ?>

<?php Pjax::end(); ?>
