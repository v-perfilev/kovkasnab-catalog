<?php

use yii\widgets\Pjax;
use yii\helpers\Html;

?>


<?php Pjax::begin(['id' => 'product-offer-list', 'enablePushState' => false, 'timeout' => 5000]); ?>

        <h3>Спецпредложение</h3>

    <?php if (empty($modelOffer)) { ?>

        <div clas="row">
            <?= Html::a('Создать', ['change-offer', 'id' => $modelProduct->id], ['class' => 'btn btn-primary']) ?>
        </div>

    <?php } else { ?>

        <div clas="row">
            <p>
                <?= Html::a('Изменить', ['change-offer', 'id' => $modelProduct->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete-offer', 'id' => $modelProduct->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить это спецпредложение?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>Спецпредолежние</td>
                        <td><?= $modelOffer->title ?></td>
                    </tr>
                    <tr>
                        <td>Стиль спецпредложения</td>
                        <td><?= $modelOffer->title_style ?></td>
                    </tr>
                    <tr>
                        <td>Спеццена</td>
                        <td><?= $modelOffer->price ?></td>
                    </tr>
                    <tr>
                        <td>Стиль спеццены</td>
                        <td><?= $modelOffer->price_style ?></td>
                    </tr>
                    <tr>
                        <td>Комментарий</td>
                        <td><?= $modelOffer->text ?></td>
                    </tr>
                </table>
            </div>
        </div>

    <?php } ?>

<?php Pjax::end(); ?>
