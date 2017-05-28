<?php
namespace frontend\controllers;

use frontend\models\ContactForm;
use Yii;
use common\models\Feature;
use common\models\FeatureValue;
use common\models\Product;
use common\models\ProductCategory;
use common\models\Post;
use frontend\models\FilterForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;


/**
 * Site controller
 */
class ProductController extends Controller
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
        $popular_products = Product::find()->orderBy('RAND()')->where(['availability' => 1])->with('productImages')->limit(4)->all();

        return $this->render('index', [
            'contact' => $contact,
            'categories' => $categories,
            'popular_products' => $popular_products,
            'random_posts' => $random_posts,
        ]);
    }

    public function actionCategory($slug)
    {
        $filterForm = new FilterForm();

        if (Yii::$app->request->isPjax) {
            $filterForm->load(Yii::$app->request->post());

            foreach($filterForm->features as $key => $f)
                if($f == 1)
                $filterFeatures[$key] = $f;
        }

        $categories = ProductCategory::find()->orderBy('order ASC')->all();
        $categories = ArrayHelper::index($categories, 'slug');
        $category = $categories[$slug];

        if($category == null)
            throw new NotFoundHttpException('The requested page does not exist.');

        $features = Feature::find()->with('featureValues')->where(['product_category_id' => $category->id])->all();

        $filter['minPrice'] = Product::find()->where(['product_category_id' => $category->id])->min('price');
        $filter['maxPrice'] = Product::find()->where(['product_category_id' => $category->id])->max('price');
        $filter['minWeight'] = Product::find()->where(['product_category_id' => $category->id])->min('weight');
        $filter['maxWeight'] = Product::find()->where(['product_category_id' => $category->id])->max('weight');
        $filter['features'] = $features;



        $contact = new ContactForm();
        $random_posts = Post::find()->orderBy('RAND()')->limit(4)->all();
        $popular_products = Product::find()->orderBy('RAND()')->where(['availability' => 1])->with('productImages')->limit(4)->all();


        $products = Product::find()->where(['availability' => 1])->with(['productImages', 'productFeatures']);

        $products = $products->where(['product_category_id' => $category->id]);

        if (Yii::$app->request->isPjax) {
            if (isset($filterForm['price_from']))
                $products->andWhere(['>=', 'price', $filterForm['price_from']]);
            if (isset($filterForm['price_to']))
                $products->andWhere(['<=', 'price', $filterForm['price_to']]);
            if (isset($filterForm['weight_from']))
                $products->andWhere(['>=', 'weight', $filterForm['weight_from']]);
            if (isset($filterForm['weight_to']))
                $products->andWhere(['<=', 'weight', $filterForm['weight_to']]);
        }
		
        $products = $products->all();


        if (Yii::$app->request->isPjax) {

            foreach($products as $key => $product) {

                $product_flag = 0;

                foreach($features as $feature) {

                    $feature_flag = 0;

                    foreach($feature->featureValues as $featureValue) {

                        if (isset($filterFeatures[$featureValue->id]) && ($feature_flag == 0))
                            $feature_flag = 1;

                        foreach($product->productFeatures as $productFeature) {

                            if($productFeature->feature_id == $feature->id)
                                if(isset($filterFeatures[$productFeature->feature_value_id]))
                                    $feature_flag = 2;
                        }
                    }

                    if ($feature_flag == 1)
                        $product_flag = 1;
                }

                if ($product_flag == 1)
                    unset($products[$key]);

            }
        }


        ArrayHelper::multisort($products, 'price', SORT_ASC);

        return $this->render('category', [
            'contact' => $contact,
            'category' => $category,
            'categories' => $categories,
            'popular_products' => $popular_products,
            'random_posts' => $random_posts,
            'products' => $products,
            'filter' => $filter,
            'filterForm' => $filterForm,
        ]);
    }

    public function actionView($slug)
    {
        $contact = new ContactForm();
        $categories = ProductCategory::find()->orderBy('order ASC')->all();
        $random_posts = Post::find()->orderBy('RAND()')->limit(4)->all();
        $popular_products = Product::find()->orderBy('RAND()')->where(['availability' => 1])->with('productImages')->limit(4)->all();

        $product = $this->findModelBySlug($slug);

        foreach($product->productFeatures as $f)
            $product->features[$f->feature_id] = $f->feature_value_id;

        $features = ArrayHelper::index(Feature::find()->all(), 'id');
        $values = ArrayHelper::index(FeatureValue::find()->all(), 'id');

        $i = 0;
        foreach($product->features as $key => $f) {
            $productFeatures[$i][0] = $features[$key]->title;
            $productFeatures[$i][1] = $values[$f]->value;
            $i++;
        }

        return $this->render('view', [
            'contact' => $contact,
            'categories' => $categories,
            'popular_products' => $popular_products,
            'random_posts' => $random_posts,
            'product' => $product,
            'productFeatures' => $productFeatures,
        ]);
    }

    protected function findModelBySlug($slug)
    {
        if (($model = Product::find()->where(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
