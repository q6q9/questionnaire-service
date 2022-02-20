<?php

use app\models\Questionnaire;
use app\services\MigrationService;
use yii\db\Migration;

/**
 * Class m220220_101904_add_indexes_to_questionnaires
 */
class m220220_101904_add_indexes_to_questionnaires extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $migrationService = new MigrationService();
        $migrationService->createIndexes(Questionnaire::tableName(), [
            'name', 'email', 'phone', 'region', 'city', 'is_male', 'rate', 'created_at'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220220_101904_add_indexes_to_questionnaires cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220220_101904_add_indexes_to_questionnaires cannot be reverted.\n";

        return false;
    }
    */
}
