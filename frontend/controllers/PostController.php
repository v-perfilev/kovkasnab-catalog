<?php
namespace frontend\controllers;

use frontend\models\ContactForm;
use common\models\Product;
use common\models\ProductCategory;
use common\models\Post;
use common\models\PostSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class PostController extends Controller
{


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $contact = new ContactForm();
        $categories = ProductCategory::find()->orderBy('order ASC')->all();
        $random_posts = Post::find()->orderBy('RAND()')->limit(4)->all();
        $popular_products = Product::find()->orderBy('RAND()')->where(['availability' => 1])->with('productImages', 'productOffer')->limit(4)->all();

        $searchModel = new PostSearch();

        Yii::$app->request->queryParams = ['sort' => [
            'defaultOrder' => [
                'created_at' => SORT_DESC,
            ]
        ]];

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_DESC,

            ]
        ]);

        return $this->render('index', [
            'contact' => $contact,
            'categories' => $categories,
            'popular_products' => $popular_products,
            'random_posts' => $random_posts,

            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($slug)
    {
        $contact = new ContactForm();
        $categories = ProductCategory::find()->orderBy('order ASC')->all();
        $random_posts = Post::find()->orderBy('RAND()')->limit(4)->all();
        $popular_products = Product::find()->orderBy('RAND()')->where(['availability' => 1])->with('productImages', 'productOffer')->limit(4)->all();

        $post = $this->findModelBySlug($slug);

        return $this->render('view', [
            'contact' => $contact,
            'categories' => $categories,
            'popular_products' => $popular_products,
            'random_posts' => $random_posts,
            'post' => $post,
        ]);
    }

    protected function findModelBySlug($slug)
    {
        if (($model = Post::find()->where(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
