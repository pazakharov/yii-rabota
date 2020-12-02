<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%specializations}}`.
 */
class m201202_080720_create_specializations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specializations}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%specializations}}');
    }
}
