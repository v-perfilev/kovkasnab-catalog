<?php

use yii\helpers\Html;
use yii\helpers\url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>


<?php Pjax::begin(['id' => 'product-offer-list', 'enablePushState' => false, 'timeout' => 5000]); ?>

<?php if (!empty($modelOffer)) { ?>
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
                </table>
            </div>
        </div>
    <?php } ?>

<?php Pjax::end(); ?>
