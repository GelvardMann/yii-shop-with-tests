<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tag}}`.
 */
class m200915_225127_create_tag_table extends Migration
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

        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-tag-name',
            '{{%tag}}',
            'name'
        );

        $this->createTable('{{%product_tag}}', [
            'product_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey(
            'pk-product_tag',
            '{{%product_tag}}',
            [
                'product_id',
                'tag_id',
            ]);

        $this->createIndex(
            'idx-product_tag-product_id',
            '{{%product_tag}}',
            'product_id'
        );

        $this->createIndex(
            'idx-product_tag-tag_id',
            '{{%product_tag}}',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-product_tag-product',
            '{{%product_tag}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-product_tag-tag',
            '{{%product_tag}}',
            'tag_id',
            '{{%tag}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_tag}}');
        $this->dropTable('{{%tag}}');
    }
}
