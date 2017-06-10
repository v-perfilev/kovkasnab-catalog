<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Post;
use common\models\ProductCategory;
use common\models\Product;

class Sitemap extends Model{

    public function getUrl(){

        $urls = array();

        //Посты
        $url_posts = Post::find()
            ->select('slug')
            ->all();
        //Формируем двумерный массив. createUrl преобразует ссылки в правильный вид.
        //Добавляем элемент массива 'daily' для указания периода обновления контента
        foreach ($url_posts as $url_post){
            $urls[] = array('/post' . Yii::$app->urlManager->createUrl([$url_post->slug]),'daily');
        }

        //Категории
        $url_categories = ProductCategory::find()
            ->select('slug')
            ->all();
        foreach ($url_categories as $url_category){
            $urls[] = array('/category' . Yii::$app->urlManager->createUrl([$url_category->slug]),'weekly');
        }

        //Продукты
        $url_products = Product::find()
            ->select('slug')
            ->all();
        foreach ($url_products as $url_product){
            $urls[] = array('/product' . Yii::$app->urlManager->createUrl([$url_product->slug]),'daily');
        }

        //Статичные страницы (у каждой свое действие контроллера)
        $arr_stat_page = [
            'contacts', 'post', 'product',
        ];
        foreach ($arr_stat_page as $url_stat){
            $urls[] = array(Yii::$app->urlManager->createUrl($url_stat),'daily');
        }

        return $urls;
    }

    //Формирует XML файл, возвращает в виде переменной
    public function getXml($urls){
        $host = Yii::$app->request->hostInfo; // домен сайта
        ob_start();

        echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.91">

            <url>
                <loc><?= $host ?></loc>
            </url>

            <?php foreach($urls as $url): ?>
                <url>
                    <loc><?= $host.$url[0] ?></loc>
                </url>
            <?php endforeach; ?>
        </urlset>

        <?php return ob_get_clean();
    }

    //Возвращает XML файл
    public function showXml($xml_sitemap){
        // устанавливаем формат отдачи контента        
        Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        //повторно т.к. может не сработать
        header("Content-type: text/xml");
        echo $xml_sitemap;
        Yii::$app->end();
    }
}