<?php

namespace common\models;

use Yii;

use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\behaviors\Slug;
use common\components\ImageHelper;


/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $image_url
 * @property string $lead_text
 * @property string $full_text
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Post extends \yii\db\ActiveRecord
{

    public $image_file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'lead_text', 'full_text'], 'required'],
            [['lead_text', 'full_text'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['title', 'slug', 'image_url', 'meta_title'], 'string', 'max' => 128],
            [['meta_description', 'meta_keywords'], 'string', 'max' => 256],
            [['title'], 'unique'],
            [['slug'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'lead_text' => 'Вступление',
            'full_text' => 'Основной текст',
            'created_at' => 'Время добавления',
            'updated_at' => 'Время обновления',
            'created_by' => 'Создал',
            'updated_by' => 'Обновил',
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
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],

        ];
    }

    // Добавление и удаление изображения

    public function upload_image()
    {
        $filePath = Yii::$app->params['uploadsPath'] . '/post-images/';
        $fileName = $this->slug . '.' . $this->image_file->extension;

        $this->image_file->saveAs($filePath . $fileName);
        copy($filePath . $fileName, $filePath . 'thumb_' . $fileName);

        ImageHelper::prepare_image($filePath . $fileName, Yii::$app->params['postImageSize'][0], Yii::$app->params['postImageSize'][1]);
        ImageHelper::prepare_image($filePath . 'thumb_' . $fileName, Yii::$app->params['postThumbImageSize'][0], Yii::$app->params['postThumbImageSize'][1]);

        $this->image_file = null;
        $this->image_url = $fileName;

        return true;
    }

    public function delete_image()
    {
        $filePath = Yii::$app->params['uploadsPath'] . '/post-images/';
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
