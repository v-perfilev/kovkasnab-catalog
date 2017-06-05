<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

if ($modelOffer->isNewRecord )
    $this->title = 'Создание спецпредложения';
else
    $this->title = 'Изменение спецпредложения';

$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelProduct->title, 'url' => ['view', 'id' => $modelProduct->id ]];
$this->params['breadcrumbs'][] = $this->title;

?>


<?php $form = ActiveForm::begin(['id' => 'offer-form']); ?>

    <?= $form->field($modelOffer, 'product_id')->hiddenInput(['value' => $modelProduct->id])->label(false); ?>

    <div class="row">

        <div class="col-md-3">
            <?= $form->field($modelOffer, 'title')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($modelOffer, 'title_style')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($modelOffer, 'price')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($modelOffer, 'price_style')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <?= $form->field($modelOffer, 'text')->widget(Widget::className(), [
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

    <?= Html::submitButton($modelOffer->isNewRecord ? 'Создать' : 'Изменить', ['class' => $modelOffer->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>