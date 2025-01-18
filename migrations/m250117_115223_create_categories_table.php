<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m250117_115223_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = $this->db->tablePrefix . 'categories';

        if ($this->db->getTableSchema($tableName, true) === null) {
            $this->createTable('{{%categories}}', [
                'cat_id' => $this->primaryKey(),
                'cat_title' => $this->string()->notNull(),
                'cat_alias' => $this->string()->notNull(),
                'cat_image' => $this->string(),
                'cat_parent' => $this->integer()->defaultValue(0),
                'cat_status' => $this->integer()->defaultValue(1),
                'cat_sort' => $this->integer()->notNull(),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}
