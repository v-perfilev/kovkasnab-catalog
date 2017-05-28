<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->registerJs('
    function reload() {
        var priceValues = [
            document.getElementById("filterform-price_from"),
            document.getElementById("filterform-price_to")
        ];

        var weightValues = [
            document.getElementById("filterform-weight_from"),
            document.getElementById("filterform-weight_to")
        ];

        priceValues[0].value = '.$filter['minPrice'].';
        priceValues[1].value = '.$filter['maxPrice'].';
        weightValues[0].value = '.$filter['minWeight'].';
        weightValues[1].value = '.$filter['maxWeight'].';

        var priceSlider = document.getElementById("price-slider");
        priceSlider.noUiSlider.set([priceValues[0].value,priceValues[1].value]);

        var weightSlider = document.getElementById("weight-slider");
        weightSlider.noUiSlider.set([weightValues[0].value,weightValues[1].value]);
    }

    $("#reset-button").click(function(){
        setTimeout(reload, 5);
    });


');

if( !empty($filter['minPrice']) && !empty($filter['maxPrice']) && $filter['minPrice']!=$filter['maxPrice'] )
    $this->registerJs('
        var priceSlider = document.getElementById("price-slider");

        noUiSlider.create(priceSlider, {
            start: ['.$filter['minPrice'].','.$filter['maxPrice'].'],
            connect: true,
            step: '. (int)(($filter['maxPrice']-$filter['minPrice'])/100) .',
            range: {
                "min": '.$filter['minPrice'].',
                "max": '.$filter['maxPrice'].'
            },
            format: wNumb({
                decimals: 0,
            })
        });

        var priceValues = [
            document.getElementById("filterform-price_from"),
            document.getElementById("filterform-price_to")
        ];
        priceSlider.noUiSlider.on("update", function( values, handle ) {
            priceValues[handle].value = values[handle];
        });

        priceValues[0].addEventListener("change", function(){
            priceSlider.noUiSlider.set([priceValues[0].value,null]);
        });
        priceValues[1].addEventListener("change", function(){
            priceSlider.noUiSlider.set([null, priceValues[1].value]);
        });
    ');

if( !empty($filter['minWeight']) && !empty($filter['maxWeight']) && $filter['minWeight']!=$filter['maxWeight'] )
    $this->registerJs('
        var weightSlider = document.getElementById("weight-slider");

        noUiSlider.create(weightSlider, {
            start: ['.$filter['minWeight'].','.$filter['maxWeight'].'],
            connect: true,
            step: '. ($filter['maxWeight']-$filter['maxWeight'])/100 .',
            range: {
                "min": '.$filter['minWeight'].',
                "max": '.$filter['maxWeight'].'
            },
            format: wNumb({
                decimals: 2,
            })
        });

        var weightValues = [
            document.getElementById("filterform-weight_from"),
            document.getElementById("filterform-weight_to")
        ];
        weightSlider.noUiSlider.on("update", function( values, handle ) {
            weightValues[handle].value = values[handle];
        });

        weightValues[0].addEventListener("change", function(){
            weightSlider.noUiSlider.set([weightValues[0].value,null]);
        });
        weightValues[1].addEventListener("change", function(){
            weightSlider.noUiSlider.set([null, weightValues[1].value]);
        });
    ');

?>


<?php Pjax::begin(['id' => 'filter-form']) ?>
<?php $form = ActiveForm::begin(['action' => ['', 'id' => $category->id],  'method' => 'post', 'options' => ['data-pjax' => true, 'class' => 'filter-form']])?>

    <?php if( !empty($filter['minPrice']) && !empty($filter['maxPrice']) && $filter['minPrice']!=$filter['maxPrice'] ) { ?>
        <div class="element">
            <h5>Цена</h5>
            <div class="line vertical-center horizontal-left">
                <?= $form->field($filterForm,'price_from')->label(false) ?> <span>-</span> <?= $form->field($filterForm,'price_to')->label(false) ?> <span>руб.</span>
            </div>
            <div id="price-slider" class="range-slider"></div>
        </div>
    <?php } ?>

    <?php if( !empty($filter['minWeight']) && !empty($filter['maxWeight']) && $filter['minWeight']!=$filter['maxWeight'] ) { ?>
        <div class="element">
            <h5>Вес</h5>
            <div class="line vertical-center horizontal-left">
                <?= $form->field($filterForm,'weight_from')->label(false) ?>  <span>-</span>  <?= $form->field($filterForm,'weight_to')->label(false) ?> <span>кг</span>
            </div>
            <div id="weight-slider" class="range-slider"></div>
        </div>
    <?php } ?>

    <?php foreach($filter['features'] as $feature) { ?>

    <div class="element">
        <h5><?= $feature->title; ?></h5>

        <?php foreach($feature->featureValues as $value) { ?>
            <div class="checkbox">
                <?= $form->field($filterForm, 'features['. $value->id .']')->checkbox([], false)->label($value->value); ?>
            </div>
        <?php } ?>

    </div>

<?php } ?>

    <div class="btn-group horizontal-right">
        <?= Html::resetButton('Сбросить', ['id' => 'reset-button', 'class' => 'btn gray']) ?>
        <?= Html::button('Фильтр', ['id' => 'submit-button','class' => 'btn red']) ?>
    </div>

<?php ActiveForm::end()?>
<?php Pjax::end() ?>
