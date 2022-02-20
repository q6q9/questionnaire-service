<?php

namespace app\services;

use yii\db\Migration;
use yii\db\MigrationInterface;

class MigrationService
{
    /**
     * @var MigrationInterface
     */
    private $migration;

    public function __construct(MigrationInterface $migration = null)
    {
        $this->migration = $migration ? $migration : new Migration();
    }

    public function createIndexes($tableName, $columns)
    {
        foreach ($columns as $column) {
            $this->migration->createIndex(
                'idx-' . $tableName . '-' . $column,
                $tableName,
                $column
            );
        }
    }
}