<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employments}}`.
 */
class m201202_081351_create_employments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employments}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employments}}');
    }
}
