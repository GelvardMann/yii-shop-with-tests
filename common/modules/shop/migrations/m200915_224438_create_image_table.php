<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m200915_224438_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-image-product_id',
            '{{%image}}',
            'product_id'
        );

        $this->addForeignKey(
            'fk-image-product_id',
            '{{%image}}',
            'product_id',
            '{{%product}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
