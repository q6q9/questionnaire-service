<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questionnaires}}`.
 */
class m220219_111859_create_questionnaires_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%questionnaires}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string(20)->notNull(),
            'region' => $this->string(64)->notNull(),
            'city' => $this->string(64)->notNull(),
            'is_male' => $this->boolean()->notNull(),
            'rate' => $this->tinyInteger()->notNull(),
            'comment' => $this->text()->notNull(),

            'created_at' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%questionnaires}}');
    }
}
