<?php

use yii\db\Migration;

class m251105_081433_create_requests_table extends Migration
{
    public function safeUp(): void
    {
        $this->execute("CREATE TYPE requests_status AS ENUM ('approved', 'declined', 'pending');");

        $this->createTable('{{%requests}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'amount' => $this->integer()->unsigned()->notNull(),
            'term' => $this->integer()->unsigned()->notNull(),
            'status' => "requests_status  default 'pending'",
        ]);

        $this->createIndex(
            name: 'idx-requests-user_id',
            table: 'requests',
            columns:'user_id',
        );

        $this->addForeignKey(
            name:'fk-requests-user_id',
            table:'requests',
            columns: 'user_id',
            refTable: 'users',
            refColumns: 'id',
            delete: 'CASCADE',
        );
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%requests}}');

        $this->execute('DROP TYPE requests_status');
    }
}
