<?php

namespace common\models;

use Yii;
use common\behaviors\Slug;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $product_category_id
 * @property string $title
 * @property string $slug
 * @property string $price
 * @property string $size
 * @property string $weight
 * @property integer $availability
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 *
 * @property ProductCategory $productCategory
 * @property ProductFeature[] $productFeatures
 * @property ProductPhoto[] $productPhotos
 */
class Product extends \yii\db\ActiveRecord
{

    public $features = array();

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'vendor'], 'required'],
            [['text'], 'string'],
            [['product_category_id', 'availability'], 'integer'],
            [['title', 'slug', 'meta_title'], 'string', 'max' => 128],
            [['vendor', 'price', 'size', 'weight'], 'string', 'max' => 32],
            [['meta_description', 'meta_keywords'], 'string', 'max' => 256],
            [['title'], 'unique'],
            [['slug'], 'unique'],
            [['vendor'], 'unique'],
            [['product_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['product_category_id' => 'id']],
            [['features'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_category_id' => 'Категория',
            'title' => 'Название',
            'slug' => 'slug',
            'vendor' => 'Артикул',
            'text' => 'Текст',
            'price' => 'Цена',
            'size' => 'Размер',
            'weight' => 'Вес',
            'availability' => 'Доступность',
            'meta_title' => 'meta-title',
            'meta_description' => 'meta-description',
            'meta_keywords' => 'meta-keywords',
        ];
    }

    // Поведение

    public function behaviors()
    {
        return [
            [
                'class' => Slug::className(),
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true,
            ],
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
    public function getProductFeatures()
    {
        return $this->hasMany(ProductFeature::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    public function getProductOffer()
    {
        return $this->hasMany(ProductOffer::className(), ['product_id' => 'id']);
    }
}
