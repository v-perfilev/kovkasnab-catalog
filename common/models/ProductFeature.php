<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_feature".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $feature_id
 * @property integer $feature_value_id
 *
 * @property Feature $feature
 * @property FeatureValue $featureValue
 * @property Product $product
 */
class ProductFeature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'feature_id', 'feature_value_id'], 'required'],
            [['product_id', 'feature_id', 'feature_value_id'], 'integer'],
            [['feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feature::className(), 'targetAttribute' => ['feature_id' => 'id']],
            [['feature_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => FeatureValue::className(), 'targetAttribute' => ['feature_value_id' => 'id']],
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
            'product_id' => 'Product ID',
            'feature_id' => 'Feature ID',
            'feature_value_id' => 'Feature Value ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeature()
    {
        return $this->hasOne(Feature::className(), ['id' => 'feature_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatureValue()
    {
        return $this->hasOne(FeatureValue::className(), ['id' => 'feature_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
