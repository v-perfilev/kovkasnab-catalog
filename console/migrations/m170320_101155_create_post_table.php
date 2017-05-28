<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170320_101155_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->unique(),
            'slug' => $this->string(128)->notNull()->unique(),
            'image_url' => $this->string(128),

            'lead_text' => $this->text(),
            'full_text' => $this->text()->notNull(),

            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),

            'meta_title' => $this->string(128),
            'meta_description' => $this->string(256),
            'meta_keywords' => $this->string(256)
        ]);

        $this->createIndex(
            'idx-post-created_by',
            'post',
            'created_by'
        );
        $this->addForeignKey(
            'fk-post-created_by',
            'post',
            'created_by',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-post-updated_by',
            'post',
            'updated_by'
        );
        $this->addForeignKey(
            'fk-post-updated_by',
            'post',
            'updated_by',
            'user',
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
        $this->dropForeignKey('fk-post-created_by', 'post');
        $this->dropForeignKey('fk-post-updated_by', 'post');
        $this->dropTable('post');
    }
}
