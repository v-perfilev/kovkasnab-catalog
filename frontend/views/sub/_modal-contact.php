<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->registerJs('

    $("#feadback-button").click( function() {
        $("#modal-contact").modal("toggle");
    });

    $(document).on("click", "#contact-form button", function(e) {
        $.ajax({
            type: "POST",
            data: $("#contact-form").serialize(),
            url: "'.Url::to(['site/contact']).'",
            success: function(data) {
                if(data == true) {
                    $("#contact-form").trigger("reset");
                    $("#modal-contact").modal("hide");
                } else {
                    alert("Ошибка отправки сообщения");
                }
            }
        });
    });

');

?>


<?php Modal::begin([
    'id' => 'modal-contact',
    'header' => 'Форма обратной связи',
    'size' => Modal::SIZE_DEFAULT
]); ?>

    <?php Pjax::begin(['id' => 'modal-contact-form', 'enablePushState' => false]); ?>

        <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
            'action' => Url::to(['site/contact']),
            'options' => ['data-pjax' => true],
        ]); ?>

            <?= $form->field($contact, 'name') ?>

            <?= $form->field($contact, 'email') ?>

            <?= $form->field($contact, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 ( 999 ) 999-99-99',
            ]) ?>

            <?= $form->field($contact, 'body')->textarea(['rows' => 6]) ?>

            <?= $form->field($contact, 'conditions')->checkbox(['label'=>'Нажимая кнопку "Отправить" я подтверждаю свою дееспособность и даю согласие на обработку персональных данных в соответствии с '.Html::a('Условиями', ['conditions'], ['target'=>'_blanc', 'data-pjax'=>0])]) ?>

            <?= $form->field($contact, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>

            <div class="form-group">
                <?= Html::button('Отправить', ['class' => 'btn red', 'name' => 'contact-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    <?php Pjax::end(); ?>


<?php Modal::end(); ?>
