<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_offer".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $title
 * @property integer $title_style
 * @property string $price
 * @property integer $price_style
 *
 * @property Product $product
 */
class ProductOffer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id'], 'integer'],
            [['title', 'price', 'title_style', 'price_style'], 'string', 'max' => 128],
            [['text'], 'string'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'ID товара',
            'title' => 'Спецпредложение',
            'title_style' => 'Стиль спецпредложения',
            'price' => 'Спеццена',
            'price_style' => 'Стиль спеццены',
            'text' => 'Комментарий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
