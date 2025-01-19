<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m250119_110401_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = $this->db->tablePrefix . 'orders';

        if ($this->db->getTableSchema($tableName, true) === null) {
            $this->createTable('{{%orders}}', [
                'order_id' => $this->primaryKey(),
                'prod_id' => $this->integer(),
                'order_date' => $this->integer()->notNull(),
                'payment_date' => $this->integer(),
                'client_email' => $this->string()->notNull(),
                'client_name' => $this->string()->notNull(),
                'client_surname' => $this->string(),
                'client_phone' => $this->string(),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
