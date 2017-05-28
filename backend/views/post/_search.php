<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'title')->textInput(['placeholder' => 'Поиск по названию'])->label(false) ?>
        </div>

        <div class="col-md-2">
            <div class="btn-group">
                <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
