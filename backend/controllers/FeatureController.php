<?php

namespace backend\controllers;

use Yii;
use common\models\Feature;
use common\models\FeatureSearch;
use common\models\FeatureValue;
use common\models\FeatureValueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FeatureController implements the CRUD actions for Feature model.
 */
class FeatureController extends Controller
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
     * Lists all Feature models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeatureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Feature model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            $modelValue = new FeatureValue();
            $modelValue->load(Yii::$app->request->post());
            $modelValue->save();
        }

        $modelFeature = $this->findModel($id);

        $modelValue = new FeatureValue();
        $searchModelValue = new FeatureValueSearch();
        $searchModelValue->feature_id = $id;
        $dataProviderValue = $searchModelValue->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'modelFeature' => $modelFeature,
            'modelValue' => $modelValue,
            'dataProviderValue' => $dataProviderValue,
        ]);
    }

    public function actionAjaxAddValue()
    {
        if (Yii::$app->request->isAjax) {

            $modelValue = new FeatureValue();
            $modelValue->load(Yii::$app->request->post());
            $modelValue->save();

            $searchModelValue = new FeatureValueSearch();
            $searchModelValue->feature_id = $modelValue->feature_id;
            $dataProviderValue = $searchModelValue->search(Yii::$app->request->queryParams);

            $modelFeature = $this->findModel($modelValue->feature_id);

            return $this->render('view', [
                'modelFeature' => $modelFeature,
                'modelValue' => $modelValue,
                'dataProviderValue' => $dataProviderValue,
            ]);
        }
    }

    /**
     * Creates a new Feature model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Feature();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateValue($id)
    {
        $model = new FeatureValue();
        $model->feature_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('createValue', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Feature model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Feature model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteValue($id)
    {
        $modelValue = FeatureValue::findOne($id);

        if( $modelValue != null )
            $modelValue->delete();

        $feature_id = $modelValue->feature_id;

        $searchModelValue = new FeatureValueSearch();
        $searchModelValue->feature_id = $feature_id;
        $dataProviderValue = $searchModelValue->search(Yii::$app->request->queryParams);

        return $this->render('view_gridview', [
            'dataProviderValue' => $dataProviderValue,
        ]);
    }

    /**
     * Finds the Feature model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feature the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feature::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
