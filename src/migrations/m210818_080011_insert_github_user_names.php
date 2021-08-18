<?php

use yii\db\Migration;

/**
 * Class m210818_080011_insert_github_user_names
 */
class m210818_080011_insert_github_user_names extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('github_user', ['name'], [
            ['lexxtor'],
            ['Kos'],
            ['JiLiZART'],
            ['summerblue'],
            ['notExists_zzzzzzzzzzzzzzz'],
            ['sad'],
            ['dad'],
            ['five'],
            ['game'],
            ['hohland'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('github_user');
    }
}
