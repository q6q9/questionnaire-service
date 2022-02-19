<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cities}}`.
 */
class m220219_192234_create_cities_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function safeUp()
    {

        $this->createTable('{{%cities}}', [
            'id' => $this->primaryKey(),
            'country' => $this->string(48)->notNull(),
            'city' => $this->string(64)->notNull(),
        ]);

        $this->createIndex(
            'idx-cities-city',
            'cities',
            'city'
        );

        $this->createIndex(
            'idx-cities-country',
            'cities',
            'country'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cities}}');
    }
}
