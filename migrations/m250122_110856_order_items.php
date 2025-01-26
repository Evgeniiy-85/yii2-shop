<?php

use yii\db\Migration;

/**
 * Class m250122_110856_order_items
 */
class m250122_110856_order_items extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $tableName = $this->db->tablePrefix . 'order_items';

        if ($this->db->getTableSchema($tableName, true) === null) {
            $this->createTable('{{%order_items}}', [
                'id' => $this->primaryKey(),
                'order_id' => $this->integer()->notNull(),
                'prod_id' => $this->integer()->notNull(),
                'prod_price' => $this->integer()->notNull(),
                'prod_title' => $this->string()->notNull(),
                'quantity' => $this->smallInteger(4)->notNull()->defaultValue(1),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250122_110856_order_items cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250122_110856_order_items cannot be reverted.\n";

        return false;
    }
    */
}
