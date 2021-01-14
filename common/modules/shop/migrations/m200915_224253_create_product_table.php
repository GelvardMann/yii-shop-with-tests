<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m200915_224253_create_product_table extends Migration
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

        // Create Product table
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'code' => $this->integer()->unique(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'category_id' => $this->integer()->notNull(),
            'new' => $this->smallInteger(1)->defaultValue(0),
            'sale' => $this->smallInteger(1)->defaultValue(0),
            'active' => $this->smallInteger(1)->defaultValue(1),
            'status_id' => $this->integer()->notNull(),
            'percent' => $this->integer()->defaultValue(0),
            'price' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-product-category_id',
            '{{%product}}',
            'category_id'
        );

        $this->createIndex(
            'idx-product-active',
            '{{%product}}',
            'active'
        );

        $this->addForeignKey(
            'fk-product-category',
            '{{%product}}',
            'category_id',
            '{{%category}}',
            'id'
        );

        $this->createIndex(
            'idx-product-status_id',
            '{{%product}}',
            'status_id'
        );

        $this->addForeignKey(
            'fk-product-status',
            '{{%product}}',
            'status_id',
            '{{%status}}',
            'id'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
