<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;


$this->title = $category->meta_title;

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $category->meta_keywords
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $category->meta_description
], 'meta-description');


$this->registerJs('
    $.pjax.defaults.timeout = 3000;

            $("#filter-form #submit-button").click( function() {
                $.pjax.reload( {
                    container: $("#products-list"),
                    history: false,
                    type: "POST",
                    data: $("#filter-form form").serialize(),
                    url: "",
                });
            });

');

$this->registerJsFile('/js/nouislider.min.js');
$this->registerJsFile('/js/wNumb.js');

$this->registerCssFile('/css/_nouislider.min.css');

?>

<?= $this->render('/sub/_modal-contact', [
    'contact' => $contact,
]) ?>

<?= $this->render('/sub/_categories-parallax', [
    'image' => Url::toRoute(['/images/parallax-catalog.jpg']),
    'categories' => $categories,
]) ?>

<div class="white-area">

    <div class="space-area"></div>

    <div class="catalog container">

        <h1><?= $category->title ?></h1>

        <div class="space-area"></div>

        <div class="row">

            <div class="col-md-9">

				<div class="row">

					<?php Pjax::begin(['id' => 'products-list']) ?>

						<?php foreach($products as $product) { ?>

							<?php
								$images = ArrayHelper::index($product->productImages, 'order');
							?>

							<div class="item col-xs-6 col-sm-4 col-md-4 col-lg-3 horizontal-center">
								<div class="wrapper-1">
									<div class="wrapper-2">
										<div class="box">
											<a href="<?= Url::to(['product/view', 'slug' => $product->slug]) ?>" title="<?= $product->productCategory->title ?> - <?= $product->title; ?>">
												<h3 class="vertical-center horizontal-center"><?= $product->title; ?></h3>
                                                <?php if($product->productOffer->title !== null) { ?>

                                                    <div class="yellow-circle vertical-center horizontal-center" style="<?= $product->productOffer->title_style ?>">
                                                        <?= $product->productOffer->title ?>
                                                    </div>

                                                <?php } ?>

												<div class="image vertical-center horizontal-center">
													<?= Html::img('/uploads/product-images/thumb_' . $images[1]->image_url, [
														'alt' => 'Миниатюра: ' .  $product->title,
														'title' => $product->title
													]) ?>
												</div>
												<div class="price vertical-center">
                                                    <?php if($product->productOffer->price !== null) { ?>

                                                        <div class="price-col vertical-center horizontal-left">
                                                            <div class="price-offer vertical-center horizontal-center" style="<?= $product->productOffer->price_style ?>">
                                                                <?= $product->productOffer->price ?>
                                                            </div>
                                                        </div>
                                                        <div class="price-col vertical-center horizontal-right">
                                                            <div class="price-actual horizontal-right"><?= $product->price ?> руб.</div>
                                                        </div>

                                                    <?php } else { ?>

                                                        <div class="price-actual horizontal-right"><?= $product->price ?> руб.</div>

                                                    <?php } ?>
												</div>

											</a>
										</div>
									</div>
								</div>
							</div>

						<?php } ?>

					<?php Pjax::end() ?>
					
				</div>

            </div>

            <div class="hidden-xs col-md-3">

                <?= $this->render('_filter', [
                    'category' => $category,
                    'filter' => $filter,
                    'filterForm' => $filterForm,
                ]) ?>

            </div>

        </div>
        
        <div class="space-area"></div>
        
        <div class="row">
            <div class="text col-md-10 col-md-offset-1">
                <?= $category->text ?>
            </div>               
        </div>
    </div>
</div>

<?= $this->render('/sub/_popular-products', [
    'popular_products' => $popular_products,
]) ?>

<?= $this->render('/sub/_random-posts', [
    'random_posts' => $random_posts,
]) ?>