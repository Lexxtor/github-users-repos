<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210818_075410_github_user
 */
class m210818_075410_github_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('github_user', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('github_user');
    }
}
