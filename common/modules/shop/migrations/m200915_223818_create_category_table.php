<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m200915_223818_create_category_table extends Migration
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

        // Create category table
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'parent_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex(
            'idx-category-parent_id',
            '{{%category}}',
            'parent_id'
        );

        $this->addForeignKey(
            'fk-category-parent_id',
            '{{%category}}',
            'parent_id',
            '{{%category}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
