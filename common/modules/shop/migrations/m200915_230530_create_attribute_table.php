<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute}}`.
 */
class m200915_230530_create_attribute_table extends Migration
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

        $this->createTable('{{%attribute}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-attribute-name',
            '{{%attribute}}',
            'name'
        );

        $this->createTable('{{%attribute_value}}', [
            'product_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
            'value' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey(
            'pk-attribute_value',
            '{{%attribute_value}}',
            [
                'product_id',
                'attribute_id',
            ]);

        $this->createIndex(
            'idx-attribute_value-product_id',
            '{{%attribute_value}}',
            'product_id'
        );

        $this->createIndex(
            'idx-attribute_value-attribute_id',
            '{{%attribute_value}}',
            'attribute_id'
        );

        $this->addForeignKey(
            'fk-attribute_value-product',
            '{{%attribute_value}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-attribute_value-attribute',
            '{{%attribute_value}}',
            'attribute_id',
            '{{%attribute}}',
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
        $this->dropTable('{{%attribute_value}}');
        $this->dropTable('{{%attribute}}');
    }
}
