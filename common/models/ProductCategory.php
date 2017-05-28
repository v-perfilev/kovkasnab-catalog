<?php

namespace common\models;

use Yii;

use common\behaviors\Slug;
use common\components\ImageHelper;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $image_url
 * @property string $text
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 *
 * @property Feature[] $features
 * @property Product[] $products
 */
class ProductCategory extends \yii\db\ActiveRecord
{

    public $image_file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text'], 'string'],
            [['title', 'slug', 'image_url', 'meta_title'], 'string', 'max' => 128],
            [['meta_description', 'meta_keywords'], 'string', 'max' => 256],
            [['title'], 'unique'],
            [['slug'], 'unique'],
            [['order'], 'integer'],
            [['image_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'slug' => 'slug',
            'image_url' => 'Изображение',
            'text' => 'Текст',
            'order' => 'Сортировка',
            'meta_title' => 'meta-title',
            'meta_title' => 'meta-title',
            'meta_description' => 'meta-description',
            'meta_keywords' => 'meta-keywords',
            'image_file' => 'Файл изображения',
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

    // Добавление и удаление изображения

    public function upload_image()
    {
        $filePath = Yii::$app->params['uploadsPath'] . '/category-images/';
        $fileName = $this->slug . '.' . $this->image_file->extension;

        $this->image_file->saveAs($filePath . $fileName);
        copy($filePath . $fileName, $filePath . 'thumb_' . $fileName);

        ImageHelper::prepare_image($filePath . $fileName, Yii::$app->params['productCategoryImageSize'][0], Yii::$app->params['productCategoryImageSize'][1]);
        ImageHelper::prepare_image($filePath . 'thumb_' . $fileName, Yii::$app->params['productCategoryThumbImageSize'][0], Yii::$app->params['productCategoryThumbImageSize'][1]);

        $this->image_file = null;
        $this->image_url = $fileName;

        return true;
    }

    public function delete_image()
    {
        $filePath = Yii::$app->params['uploadsPath'] . '/category-images/';
        $fileName = $this->image_url;

        if (file_exists($filePath . $fileName))
			if(is_file($filePath . $fileName))
				unlink($filePath . $fileName);
        if (file_exists($filePath . 'thumb_' . $fileName))
			if(is_file($filePath . 'thumb_' . $fileName))
				unlink($filePath . 'thumb_' . $fileName);

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatures()
    {
        return $this->hasMany(Feature::className(), ['product_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['product_category_id' => 'id']);
    }
}
