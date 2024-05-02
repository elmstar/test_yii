<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects}}`.
 */
class m240502_135657_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%projects}}', [
            'id' => $this->primaryKey(),
            'user_id'   => $this->integer()->notNull(),
            'title'     => $this->string(254),
            'price'     => $this->decimal(9,2),
            'date_start' => $this->timestamp(),
            'deadline'  => $this->timestamp()
        ]);
        $this->addForeignKey(
            'fk-projects-user_id',
            'projects',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%projects}}');
    }
}
