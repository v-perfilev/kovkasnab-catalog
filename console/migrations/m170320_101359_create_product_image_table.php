<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_photo`.
 */
class m170320_101359_create_product_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_image', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'image_url' => $this->string(128),
            'order' => $this->integer()
        ]);

        $this->createIndex(
            'idx-product_image-product_id',
            'product_image',
            'product_id'
        );

        $this->addForeignKey(
            'fk-product_image-product_id',
            'product_image',
            'product_id',
            'product',
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
        $this->dropForeignKey('fk-product_photo-product_id', 'product_photo');
        $this->dropTable('product_photo');
    }
}
