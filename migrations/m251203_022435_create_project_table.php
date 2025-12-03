<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m251203_022435_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'status' => $this->string(20)->notNull()->defaultValue('active'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // foreign key: project.client_id → client.id
        $this->addForeignKey(
            'fk_project_client',
            '{{%project}}', 'client_id',
            '{{%client}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_project_client', '{{%project}}');
        $this->dropTable('{{%project}}');
    }

}
