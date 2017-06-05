<?php

use yii\helpers\Html;
use yii\helpers\url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>


<?php Pjax::begin(['id' => 'product-image-form', 'enablePushState' => false, 'timeout' => 5000]); ?>
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['ajax-add-image', 'id' => $modelProduct->id]),
        'options' => ['data-pjax' => true],
    ]); ?>

        <?= $form->field($modelImage, 'product_id')->hiddenInput(['value' => $modelProduct->id])->label(false); ?>
        <?= $form->field($modelImage, 'image_file')->fileInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
