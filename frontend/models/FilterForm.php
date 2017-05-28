<?php

namespace frontend\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class FilterForm extends Model
{
    public $price_from;
    public $price_to;
    public $weight_from;
    public $weight_to;

    public $features;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price_from', 'price_to', 'weight_from', 'weight_to'], 'double'],
            [['features'], 'each', 'rule' => ['integer']],
        ];
    }

}
