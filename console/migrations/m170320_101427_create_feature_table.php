<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feature`.
 */
class m170320_101427_create_feature_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('feature', [
            'id' => $this->primaryKey(),
            'product_category_id' => $this->integer()->notNull(),
            'title' => $this->string(128)->notNull(),
        ]);

        $this->createIndex(
            'idx-feature-product_category_id',
            'feature',
            'product_category_id'
        );
        $this->addForeignKey(
            'fk-feature-product_category_id',
            'feature',
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
        $this->dropForeignKey('fk-feature-product_category_id', 'feature');
        $this->dropTable('feature');
    }
}
