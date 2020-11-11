<?php

use yii\db\Migration;

/**
 * Class m201108_153220_add_tables
 */
class m201108_153220_add_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'price' => $this->integer(),
        ], $tableOptions);

        for ($i = 0; $i < 20; $i++) {
            $this->insert('products', [
                'name' => 'product' . ($i + 1),
                'price' => rand(0, 100),
            ]);
        }

        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'status' => $this->integer()->notNull(),
            'sum' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('order_items', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer(),
            'price' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('idx-order_items-order_id', 'order_items', 'order_id');
        $this->addForeignKey('fk-order_items-order_id', 'order_items', 'order_id', 'orders', 'id', 'CASCADE');
        $this->addForeignKey('fk-order_items-product_id', 'order_items', 'product_id', 'products', 'id', 'SET NULL');
    }

    /**
     * @inheritDoc
     */
    public function safeDown()
    {
        $this->dropTable('order_items');
        $this->dropTable('orders');
        $this->dropTable('products');
    }
}