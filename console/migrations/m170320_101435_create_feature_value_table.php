<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feature_value`.
 */
class m170320_101435_create_feature_value_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('feature_value', [
            'id' => $this->primaryKey(),
            'feature_id' => $this->integer()->notNull(),
            'value' => $this->string(128)->notNull(),
        ]);

        $this->createIndex(
            'idx-feature_value-feature_id',
            'feature_value',
            'feature_id'
        );
        $this->addForeignKey(
            'fk-feature_value-feature_id',
            'feature_value',
            'feature_id',
            'feature',
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
        $this->dropForeignKey('fk-feature_value-feature_id', 'feature_value');
        $this->dropTable('feature_value');
    }
}
