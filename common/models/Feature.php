<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feature".
 *
 * @property integer $id
 * @property integer $product_category_id
 * @property string $title
 *
 * @property ProductCategory $productCategory
 * @property FeatureValue[] $featureValues
 * @property ProductFeature[] $productFeatures
 */
class Feature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['product_category_id'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['product_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['product_category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_category_id' => 'ID категории товаров',
            'title' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'product_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatureValues()
    {
        return $this->hasMany(FeatureValue::className(), ['feature_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFeatures()
    {
        return $this->hasMany(ProductFeature::className(), ['feature_id' => 'id']);
    }
}
