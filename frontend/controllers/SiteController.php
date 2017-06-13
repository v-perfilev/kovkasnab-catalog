<?php
namespace frontend\controllers;

use common\models\Product;
use common\models\ProductCategory;
use common\models\Post;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Sitemap;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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
                'foreColor'=>0x872925,
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
        $this->view->registerCssFile(Url::toRoute(['/css/header-home.css']), ['depends' => ['frontend\assets\AppAsset']]);
        //$this->layout = 'home';

        $contact = new ContactForm();
        $categories = ProductCategory::find()->orderBy('order ASC')->all();
        $random_posts = Post::find()->orderBy('RAND()')->limit(4)->all();
        $popular_products = Product::find()->orderBy('RAND()')->where(['availability' => 1])->with('productImages', 'productOffer')->limit(4)->all();

        return $this->render('index', [
            'contact' => $contact,
            'categories' => $categories,
            'popular_products' => $popular_products,
            'random_posts' => $random_posts,
        ]);
    }

    public function actionContacts()
    {

        $contact = new ContactForm();
        $categories = ProductCategory::find()->orderBy('order ASC')->all();
        $random_posts = Post::find()->orderBy('RAND()')->limit(4)->all();
        $popular_products = Product::find()->orderBy('RAND()')->where(['availability' => 1])->with('productImages', 'productOffer')->limit(4)->all();

        return $this->render('contacts', [
            'contact' => $contact,
            'categories' => $categories,
            'popular_products' => $popular_products,
            'random_posts' => $random_posts,
        ]);
    }

    public function actionSitemapxml(){
        $sitemap = new Sitemap();
        //Если в кэше нет карты сайта
        if (!$xml_sitemap = Yii::$app->cache->get('sitemap')) {
            //Получаем мыссив всех ссылок
            $urls = $sitemap->getUrl();
            //Формируем XML файл
            $xml_sitemap = $sitemap->getXml($urls);
            // кэшируем результат
            Yii::$app->cache->set('sitemap', $xml_sitemap, 3600*12);
        }
        //Выводим карту сайта
        $sitemap->showXml($xml_sitemap);
    }


    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        if (Yii::$app->request->isAjax) {
            $model = new ContactForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * Displays sitemap page.
     *
     * @return mixed
     */
    public function actionSitemap()
    {
        $this->layout = 'home';

        $contact = new ContactForm();
        $categories = ProductCategory::find()->orderBy('order ASC')->all();
        $random_posts = Post::find()->orderBy('RAND()')->limit(4)->all();
        $popular_products = Product::find()->orderBy('RAND()')->where(['availability' => 1])->with('productImages', 'productOffer')->limit(4)->all();

        return $this->render('sitemap', [
            'contact' => $contact,
            'categories' => $categories,
            'popular_products' => $popular_products,
            'random_posts' => $random_posts,
        ]);
    }

    public function actionConditions()
    {
        $this->layout = 'home';

        $contact = new ContactForm();
        $categories = ProductCategory::find()->orderBy('order ASC')->all();
        $random_posts = Post::find()->orderBy('RAND()')->limit(4)->all();
        $popular_products = Product::find()->orderBy('RAND()')->where(['availability' => 1])->with('productImages', 'productOffer')->limit(4)->all();

        return $this->render('conditions', [
            'contact' => $contact,
            'categories' => $categories,
            'popular_products' => $popular_products,
            'random_posts' => $random_posts,
        ]);
    }


}
