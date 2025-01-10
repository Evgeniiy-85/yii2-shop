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

        $this->createTable('{{%products}}', [
            'prod_id' => $this->primaryKey(),
            'prod_alias' => $this->string()->notNull()->unique(),
            'prod_title' => $this->string()->notNull()->unique(),
            'prod_image' => $this->string(),
            'prod_status' => $this->integer()->notNull()->defaultValue(1),
            'prod_price' => $this->integer(),
        ], $table_options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
