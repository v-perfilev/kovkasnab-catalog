<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m170320_101324_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'product_category_id' => $this->integer()->notNull(),
            'title' => $this->string(128)->notNull()->unique(),
            'slug' => $this->string(128)->notNull()->unique(),
            'vendor' => $this->string(32)->notNull()->unique(),
            'text' => $this->text(),

            'price' => $this->float(),
            'size' => $this->string(32),
            'weight' => $this->double(),

            'availability' => $this->boolean(),

            'meta_title' => $this->string(128),
            'meta_description' => $this->string(256),
            'meta_keywords' => $this->string(256),
        ]);

        $this->createIndex(
            'idx-product-product_category_id',
            'product',
            'product_category_id'
        );
        $this->addForeignKey(
            'fk-product-product_category_id',
            'product',
            'product_category_id',
            'product_category',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-product-product_category_id', 'product');
        $this->dropTable('product');
    }
}
