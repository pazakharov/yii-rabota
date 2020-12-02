<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%experience}}`.
 */
class m201202_101023_create_experience_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%experience}}', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'date1' => $this->date()->notNull(),
            'date2' => $this->date()->notNull(),
            'organization' => $this->string()->notNull(),
            'position' => $this->string()->notNull(),
            'duties' => $this->text(),
            'month1' => $this->integer()->notNull(),
            'year1' => $this->integer()->notNull(),
            'month2' => $this->integer()->notNull(),
            'year2' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-experience-resume_id',
            'experience',
            'resume_id'
        );

        $this->addForeignKey(
            'fk-experience-resume_id',
            'experience',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-experience-resume_id',
            'experience'
        );

        $this->dropIndex(
            'idx-experience-resume_id',
            'experience'
        );

        $this->dropTable('{{%experience}}');
    }
}
