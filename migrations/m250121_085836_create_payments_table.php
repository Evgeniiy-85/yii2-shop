<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payments}}`.
 */
class m250121_085836_create_payments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = $this->db->tablePrefix . 'payments';

        if ($this->db->getTableSchema($tableName, true) === null) {
            $this->createTable('{{%payments}}', [
                'pay_id' => $this->primaryKey(),
                'pay_name' => $this->string()->notNull(),
                'pay_title' => $this->string(256),
                'pay_desc' => $this->string(),
                'pay_sort' => $this->integer()->defaultValue(1),
                'pay_status' => $this->integer()->defaultValue(0),
                'pay_image' => $this->string(),
                'pay_params' => $this->text(),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%payments}}');
    }
}
