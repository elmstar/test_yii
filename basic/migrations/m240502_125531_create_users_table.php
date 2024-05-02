<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m240502_125531_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(64),
            'login'     => $this->string(64),
            'password' => $this->string(128),
            'authKey'   => $this->string(254),
            'accessToken'   => $this->string(254)
        ]);
        $this->insert('users', [
            'username' => 'admin',
            'login' => 'admin',
            'password'  => 'admin',
            'authKey' => \Yii::$app->security->generateRandomString()
            ]);
        //$this->insert('api_token', [
        //            'name' => "santrek_1c",
        //            'token' => "E18j1D79KALb4rpW",
        //        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
