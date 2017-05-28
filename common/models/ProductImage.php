<?php

namespace common\models;

use Yii;
use common\components\ImageHelper;

/**
 * This is the model class for table "product_photo".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $photo_url
 * @property integer $order
 *
 * @property Product $product
 */
class ProductImage extends \yii\db\ActiveRecord
{

    public $image_file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'order'], 'integer'],
            [['image_url'], 'string', 'max' => 256],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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
            'product_id' => 'ID товара',
            'image_url' => 'URL файла',
            'order' => 'Сортировка',
            'image_file' => 'Файл изображения',
        ];
    }

    // Добавление и удаление изображения

    public function upload_image()
    {
        $filePath = Yii::$app->params['uploadsPath'] . '/product-images/';
        $fileName = $this->image_url;


        $this->image_file->saveAs($filePath . $fileName);

        copy($filePath . $fileName, $filePath . 'thumb_' . $fileName);

        ImageHelper::prepare_image($filePath . $fileName, Yii::$app->params['productImageSize'][0], Yii::$app->params['productImageSize'][1]);
        ImageHelper::prepare_image($filePath . 'thumb_' . $fileName, Yii::$app->params['productThumbImageSize'][0], Yii::$app->params['productThumbImageSize'][1]);

        return true;
    }

    public function delete_image()
    {
        $filePath = Yii::$app->params['uploadsPath'] . '/product-images/';

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
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
