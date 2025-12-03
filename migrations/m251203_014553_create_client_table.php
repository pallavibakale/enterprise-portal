<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m251203_014553_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
{
    $this->createTable('{{%client}}', [
        'id' => $this->primaryKey(),
        'name' => $this->string()->notNull(),
        'contact_email' => $this->string()->notNull(),
        'created_at' => $this->integer()->notNull(),
        'updated_at' => $this->integer()->notNull(),
    ]);
}

public function safeDown()
{
    $this->dropTable('{{%client}}');
}

}
