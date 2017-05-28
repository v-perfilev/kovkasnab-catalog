<?php

namespace backend\controllers;

use Yii;
use common\models\ProductCategory;
use common\models\ProductCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * ProductCategoryController implements the CRUD actions for ProductCategory model.
 */
class ProductCategoryController extends Controller
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
     * Lists all ProductCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['order'=>SORT_ASC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductCategory();

        if ($model->load(Yii::$app->request->post())) {

            $model->order = ProductCategory::find()->count() + 1;

            $model->image_file = UploadedFile::getInstance($model, 'image_file');

            if ($model->image_file && $model->validate())
                $model->upload_image();

            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->image_file = UploadedFile::getInstance($model, 'image_file');

            if ($model->image_file && $model->validate()) {
                $model->delete_image();
                $model->upload_image();
            }

            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $categories = ProductCategory::find()->where(['>', 'order', $model->order])->all();

        foreach($categories as $category) {
            $category->order = $category->order - 1;
            $category->save();
        }

        $model->delete_image();
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionUpCategory($id)
    {
        if(Yii::$app->request->isAjax) {

            $modelCategory = ProductCategory::findOne($id);
            $modelCategory_ = ProductCategory::findOne(['order' => $modelCategory->order - 1]);

            if( isset($modelCategory_) )
            {
                $modelCategory_->order = $modelCategory->order;
                $modelCategory_->save();
                $modelCategory->order = $modelCategory->order - 1;
                $modelCategory->save();

            }

            $searchModel = new ProductCategorySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->setSort(['defaultOrder' => ['order'=>SORT_ASC]]);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        return $this->redirect(['index']);
    }

    public function actionDownCategory($id)
    {
        if(Yii::$app->request->isAjax) {
            $modelCategory = ProductCategory::findOne($id);
            $modelCategory_ = ProductCategory::findOne(['order' => $modelCategory->order + 1]);

            if( isset($modelCategory_) )
            {
                $modelCategory_->order = $modelCategory->order;
                $modelCategory_->save();
                $modelCategory->order = $modelCategory->order + 1;
                $modelCategory->save();
            }

            $searchModel = new ProductCategorySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->setSort(['defaultOrder' => ['order'=>SORT_ASC]]);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
