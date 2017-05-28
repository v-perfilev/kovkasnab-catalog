<?php

namespace backend\controllers;

use Yii;

use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\models\Product;
use common\models\ProductSearch;
use common\models\ProductImage;
use common\models\ProductImageSearch;
use common\models\ProductFeature;
use common\models\Feature;
use common\models\FeatureValue;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $modelProduct = $this->findModel($id);

        foreach($modelProduct->productFeatures as $f)
            $modelProduct->features[$f->feature_id] = $f->feature_value_id;

        $features = ArrayHelper::index(Feature::find()->all(), 'id');
        $values = ArrayHelper::index(FeatureValue::find()->all(), 'id');

        $i = 0;
        foreach($modelProduct->features as $key => $f) {
            $productFeatures[$i][0] = $features[$key]->title;
            $productFeatures[$i][1] = $values[$f]->value;
            $i++;
        }

        $modelImage = new ProductImage();

        $searchModelImage = new ProductImageSearch();
        $searchModelImage->product_id = $id;
        $dataProviderImage = $searchModelImage->search(Yii::$app->request->queryParams);
        $dataProviderImage->setSort(['defaultOrder' => ['order'=>SORT_ASC]]);

        return $this->render('view', [
            'modelProduct' => $modelProduct,
            'productFeatures' => $productFeatures,
            'modelImage' => $modelImage,
            'dataProviderImage' => $dataProviderImage,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelProduct = new Product();

        if($modelProduct->isNewRecord) {
            $modelProduct->availability = true;
        }

        if ($modelProduct->load(Yii::$app->request->post()) && $modelProduct->save()) {

            foreach( $modelProduct->productFeatures as $p )
                if (ArrayHelper::keyExists($p->feature_id, $modelProduct->features, false)) {
                    $modelFeature = ProductFeature::findOne(['feature_id' => $p->feature_id, 'product_id' => $p->product_id]);
                    $modelFeature->feature_value_id = $modelProduct->features[$p->feature_id]['value'];
                    $modelProduct->features[$p->feature_id]['flag'] = '1';
                    $modelFeature->save();
                } else {
                    $modelFeature = ProductFeature::findOne(['feature_id' => $p->feature_id, 'product_id' => $p->product_id ]);
                    $modelFeature->delete();
                }

            foreach( $modelProduct->features as $key => $f )
                if( $f['flag']!=1 ) {
                    $modelFeature = new ProductFeature();
                    $modelFeature->product_id = $modelProduct->id;
                    $modelFeature->feature_id = $key;
                    $modelFeature->feature_value_id = $f['value'];
                    $modelFeature->save();
                }

            return $this->redirect(['view', 'id' => $modelProduct->id]);
        } else {
            foreach($modelProduct->productFeatures as $f)
                $modelProduct->features[$f->feature_id]['value'] = $f->feature_value_id;
            return $this->render('create', [
                'model' => $modelProduct,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelProduct = $this->findModel($id);

        if ($modelProduct->load(Yii::$app->request->post()) && $modelProduct->save()) {

            foreach( $modelProduct->productFeatures as $p )
                if (ArrayHelper::keyExists($p->feature_id, $modelProduct->features, false)) {
                    $modelFeature = ProductFeature::findOne(['feature_id' => $p->feature_id, 'product_id' => $p->product_id]);
                    $modelFeature->feature_value_id = $modelProduct->features[$p->feature_id]['value'];
                    $modelProduct->features[$p->feature_id]['flag'] = '1';
                    $modelFeature->save();
                } else {
                    $modelFeature = ProductFeature::findOne(['feature_id' => $p->feature_id, 'product_id' => $p->product_id ]);
                    $modelFeature->delete();
                }

            foreach( $modelProduct->features as $key => $f )
                if( $f['flag']!=1 ) {
                    $modelFeature = new ProductFeature();
                    $modelFeature->product_id = $modelProduct->id;
                    $modelFeature->feature_id = $key;
                    $modelFeature->feature_value_id = $f['value'];
                    $modelFeature->save();
                }



            return $this->redirect(['view', 'id' => $modelProduct->id]);
        } else {
            foreach($modelProduct->productFeatures as $f)
                $modelProduct->features[$f->feature_id]['value'] = $f->feature_value_id;
            return $this->render('update', [
                'model' => $modelProduct,
            ]);
        }
    }

    public function actionRefreshForm()
    {
        $modelProduct = new Product();

        if(Yii::$app->request->isAjax) {
            if ($modelProduct->load(Yii::$app->request->post()))
            {
                foreach($modelProduct->productFeatures as $f)
                    $modelProduct->features[$f->feature_id]['value'] = $f->feature_value_id;
                return $this->render('_form', [
                    'model' => $modelProduct,
                ]);
            }
        }
    }

    public function actionAddImage($id)
    {
        if(Yii::$app->request->isAjax) {

            $modelImage = new ProductImage();

            if ($modelImage->load(Yii::$app->request->post())) {

                $modelImage->image_file = UploadedFile::getInstance($modelImage, 'image_file');
                $modelImage->product_id = $id;
                $modelImage->order = ProductImage::find()->where(['product_id' => $id])->count() + 1;

                if ($modelImage->validate()) {
                    $modelImage->save();
                    $modelImage->image_url = $modelImage->product->slug . '-' . $modelImage->id . '.' . $modelImage->image_file->extension;
                    $modelImage->save();
                    $modelImage->upload_image();
                }
            }

            $modelProduct = $this->findModel($id);
            foreach($modelProduct->productFeatures as $f)
                $modelProduct->features[$f->feature_id] = $f->feature_value_id;

            $searchModelImage = new ProductImageSearch();
            $searchModelImage->product_id = $modelImage->product_id;
            $dataProviderImage = $searchModelImage->search(Yii::$app->request->queryParams);
            $dataProviderImage->setSort(['defaultOrder' => ['order'=>SORT_ASC]]);

            return $this->render('view', [
                'modelProduct' => $modelProduct,
                'modelImage' => $modelImage,
                'dataProviderImage' => $dataProviderImage,
            ]);
        }
        return $this->redirect(['index']);
    }

    public function actionUpImage($id)
    {
        if(Yii::$app->request->isAjax) {
            $modelImage = ProductImage::findOne($id);
            $modelImage_ = ProductImage::findOne(['product_id' => $modelImage->product_id,'order' => $modelImage->order - 1]);
            if( isset($modelImage_) )
            {
                $modelImage_->order = $modelImage->order;
                $modelImage_->save();
                $modelImage->order = $modelImage->order - 1;
                $modelImage->save();
            }

            $product_id = $modelImage->product_id;

            $searchModelImage = new ProductImageSearch();
            $searchModelImage->product_id = $product_id;
            $dataProviderImage = $searchModelImage->search(Yii::$app->request->queryParams);
            $dataProviderImage->setSort(['defaultOrder' => ['order'=>SORT_ASC]]);

            return $this->render('view_gridview', [
                'dataProviderImage' => $dataProviderImage,
            ]);
        }
        return $this->redirect(['index']);
    }
    public function actionDownImage($id)
    {
        if(Yii::$app->request->isAjax) {
            $modelImage = ProductImage::findOne($id);
            $modelImage_ = ProductImage::findOne(['product_id' => $modelImage->product_id,'order' => $modelImage->order + 1]);
            if( isset($modelImage_) )
            {
                $modelImage_->order = $modelImage->order;
                $modelImage_->save();
                $modelImage->order = $modelImage->order + 1;
                $modelImage->save();
            }

            $product_id = $modelImage->product_id;

            $searchModelImage = new ProductImageSearch();
            $searchModelImage->product_id = $product_id;
            $dataProviderImage = $searchModelImage->search(Yii::$app->request->queryParams);
            $dataProviderImage->setSort(['defaultOrder' => ['order'=>SORT_ASC]]);

            return $this->render('view_gridview', [
                'dataProviderImage' => $dataProviderImage,
            ]);
        }
        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        if(Yii::$app->request->isAjax)
        {
            $modelImage = ProductImage::findOne($id);

            $images = ProductImage::find()->where(['product_id' => $modelImage->product_id])->andWhere(['>', 'order', $modelImage->order])->all();

            foreach($images as $image) {
                $image->order = $image->order - 1;
                $image->save();
            }

            if(isset($modelImage->image_url))
                $modelImage->delete_image();
            $modelImage->delete();

            $product_id = $modelImage->product_id;

            $searchModelImage = new ProductImageSearch();
            $searchModelImage->product_id = $product_id;
            $dataProviderImage = $searchModelImage->search(Yii::$app->request->queryParams);
            $dataProviderImage->setSort(['defaultOrder' => ['order'=>SORT_ASC]]);

            return $this->render('view_gridview', [
                'dataProviderImage' => $dataProviderImage,
            ]);

        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
