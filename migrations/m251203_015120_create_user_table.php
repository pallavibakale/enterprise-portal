<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m251203_015120_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
{
    $this->createTable('{{%user}}', [
        'id' => $this->primaryKey(),
        'username' => $this->string()->notNull()->unique(),
        'password_hash' => $this->string()->notNull(),
        'auth_key' => $this->string(32)->notNull(),
        'role' => $this->string(20)->notNull()->defaultValue('client'), // admin, staff, client
        'client_id' => $this->integer()->null(), // client user link
        'created_at' => $this->integer()->notNull(),
        'updated_at' => $this->integer()->notNull(),
    ]);

    // foreign key: user.client_id → client.id
    $this->addForeignKey(
        'fk_user_client',
        '{{%user}}', 'client_id',
        '{{%client}}', 'id',
        'SET NULL', 'CASCADE'
    );
}

public function safeDown()
{
    $this->dropForeignKey('fk_user_client', '{{%user}}');
    $this->dropTable('{{%user}}');
}
}