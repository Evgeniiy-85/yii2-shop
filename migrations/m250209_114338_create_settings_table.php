<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m250209_114338_create_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'site_name' => $this->string()->notNull(),
            'favicon' => $this->string(32),
            'logo' => $this->string(32),
            'currency' => $this->string(64)->notNull(),
            'admin_email' => $this->string()->defaultValue(null),
            'page_count_entries' => $this->tinyInteger()->notNull()->defaultValue(20),
            'cookie_name' => $this->string(32),
            'upload_max_size' => $this->smallInteger(4)->notNull()->defaultValue(128),
            'mail_send_type' => $this->tinyInteger()->notNull()->defaultValue(1),
            'mail_host' => $this->tinyInteger()->defaultValue(null),
            'mail_port' => $this->tinyInteger()->defaultValue(null),
            'mail_user_name' => $this->string()->defaultValue(null),
            'mail_user_pass' => $this->string()->defaultValue(null),
            'mail_encrypt_type' => $this->tinyInteger()->notNull()->defaultValue(1),
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
