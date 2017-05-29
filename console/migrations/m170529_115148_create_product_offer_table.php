<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_offer`.
 */
class m170529_115148_create_product_offer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

        $this->createTable('product_offer', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'title' => $this->string(128),
            'title_style' => $this->integer(),
            'price' => $this->string(128),
            'price_style' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-product_offer-product_id',
            'product_offer',
            'product_id'
        );

        $this->addForeignKey(
            'fk-product_offer-product_id',
            'product_offer',
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
        $this->dropForeignKey('fk-product_offer-product_id', 'product');
        $this->dropTable('product_offer');
    }
}
