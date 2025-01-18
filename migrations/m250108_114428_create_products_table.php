<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m250108_114428_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_options = null;
        if ($this->db->driverName === 'mysql') {
            $table_options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $tableName = $this->db->tablePrefix . 'products';
        if ($this->db->getTableSchema($tableName, true) === null) {
            $this->createTable('{{%products}}', [
                'prod_id' => $this->primaryKey(),
                'prod_alias' => $this->string()->notNull()->unique(),
                'prod_title' => $this->string()->notNull(),
                'prod_image' => $this->string(),
                'prod_price' => $this->integer(),
                'prod_category' => $this->integer()->defaultValue(0),
                'prod_article' => $this->string(),
                'prod_quantity' => $this->integer()->defaultValue(null),
                'prod_status' => $this->integer()->notNull()->defaultValue(1),
            ], $table_options);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
