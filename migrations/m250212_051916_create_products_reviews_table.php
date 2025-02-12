<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products_reviews}}`.
 */
class m250212_051916_create_products_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_reviews}}', [
            'review_id' => $this->primaryKey(),
            'review_advantage' => $this->text()->notNull(),
            'review_disadvantage' => $this->text()->notNull(),
            'review_comment' => $this->text()->notNull(),
            'review_rating' => $this->tinyInteger()->notNull(),
            'prod_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'create_date' => $this->integer()->notNull(),
            'review_status' => $this->tinyInteger()->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products_reviews}}');
    }
}
