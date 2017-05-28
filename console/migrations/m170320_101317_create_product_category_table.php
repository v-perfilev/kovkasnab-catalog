<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_category`.
 */
class m170320_101317_create_product_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_category', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->unique(),
            'slug' => $this->string(128)->notNull()->unique(),
            'image_url' => $this->string(128),

            'text' => $this->text(),

            'order' => $this->integer(),

            'meta_title' => $this->string(128),
            'meta_description' => $this->string(256),
            'meta_keywords' => $this->string(256),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_category');
    }
}
