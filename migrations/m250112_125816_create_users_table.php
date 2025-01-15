<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m250112_125816_create_users_table extends Migration
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

        $tableName = $this->db->tablePrefix . 'users';
        if ($this->db->getTableSchema($tableName, true) === null) {
            $this->createTable('{{%users}}', [
                'user_id' => $this->primaryKey(),
                'user_email' => $this->string()->notNull(),
                'user_name' => $this->string(),
                'user_surname' => $this->string(),
                'user_patronymic' => $this->string(),
                'user_phone' => $this->string(),
                'user_photo' => $this->string(),
                'created_at' => $this->integer(),
                'user_auth_key' => $this->string(),
                'user_password_hash' => $this->string()->notNull(),
                'user_status' => $this->integer()->notNull()->defaultValue(\app\models\Users::STATUS_ACTIVE),
                'user_create_date' => $this->integer()->notNull(),
                'user_last_visit_date' => $this->integer(),
            ], $table_options);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
