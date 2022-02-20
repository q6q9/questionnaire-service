<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Exception;
use app\factories\QuestionnaireFactory;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Questionnaires Factory
 *
 * This command is provided as an example for you to learn how to create console commands.
 */
class QuestionnairesFactoryController extends Controller
{
    /**
     * Generate models by $count
     *
     * @param int $count
     * @return int Exit code
     */
    public function actionIndex($count)
    {
        echo "Beginning..." . "\n";
        $this->safeGenerate($count);
        echo "Successfully..." . "\n";
        return ExitCode::OK;
    }

    /**
     * @param int $max
     * @param int $generated
     * @return void
     */
    protected function safeGenerate($max, $generated = 0)
    {
        if ($generated >= $max) {
            return;
        }

        $count = min($max - $generated, 4000);;
        try {
            QuestionnaireFactory::generate($count);
        } catch (Exception $e) {
            $count = 0;
        }
        $this->safeGenerate($max, $generated + $count);
    }
}
