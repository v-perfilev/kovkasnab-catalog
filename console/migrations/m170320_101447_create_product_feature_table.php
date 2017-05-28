<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_feature`.
 */
class m170320_101447_create_product_feature_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_feature', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'feature_id' => $this->integer()->notNull(),
            'feature_value_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-product_feature-product_id',
            'product_feature',
            'product_id'
        );
        $this->addForeignKey(
            'fk-product_feature-product_id',
            'product_feature',
            'product_id',
            'product',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product_feature-feature_id',
            'product_feature',
            'feature_id'
        );
        $this->addForeignKey(
            'fk-product_feature-feature_id',
            'product_feature',
            'feature_id',
            'feature',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product_feature-feature_value_id',
            'product_feature',
            'feature_value_id'
        );
        $this->addForeignKey(
            'fk-product_feature-feature_value_id',
            'product_feature',
            'feature_value_id',
            'feature_value',
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
        $this->dropForeignKey('fk-product_feature-product_id', 'product_feature');
        $this->dropForeignKey('fk-product_feature-feature_id', 'product_feature');
        $this->dropForeignKey('fk-product_feature-feature_value_id', 'product_feature');
        $this->dropTable('product_feature');
    }
}
