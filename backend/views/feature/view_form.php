<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Feature */

?>

<?php Pjax::begin(['id' => 'feature-value-form', 'timeout' => 50000, 'enablePushState' => false]); ?>
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['ajax-add-value']),
        'options' => ['data-pjax' => true],
    ]); ?>

        <?= $form->field($modelValue, 'feature_id')->hiddenInput(['value' => $modelFeature->id])->label(false); ?>
        <?= $form->field($modelValue, 'value')->textInput(['maxlength' => true]) ?>

        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>