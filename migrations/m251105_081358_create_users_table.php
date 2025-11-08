<?php

use yii\db\Migration;

class m251105_081358_create_users_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%users}}');
    }
}
