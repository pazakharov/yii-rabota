<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resume}}`.
 */
class m201202_081649_create_resume_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resume}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(11)->notNull(),
            'first_name' => $this->string()->notNull(),
            'middle_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'birthdate' => $this->date()->notNull(),
            'sex' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'mail' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'specialization_id' => $this->integer(11)->notNull(),
            'about' => $this->text(),
            'foto' => $this->string()->notNull(),
            'zp' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-resume-author_id',
            'resume',
            'author_id'
        );

        $this->addForeignKey(
            'fk-resume-author_id',
            'resume',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume-specialization_id',
            'resume',
            'specialization_id'
        );

        $this->addForeignKey(
            'fk-resume-specialization_id',
            'resume',
            'specialization_id',
            'specializations',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%resume_employment_tbl}}', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'employment_id' => $this->integer()->notNull(),
        ]);


        $this->createIndex(
            'idx-resume_employment_tbl-resume_id',
            'resume_employment_tbl',
            'resume_id'
        );

        $this->createIndex(
            'idx-resume_employment_tbl-employment_id',
            'resume_employment_tbl',
            'employment_id'
        );

        $this->addForeignKey(
            'fk-resume_employment_tbl-resume',
            'resume_employment_tbl',
            'resume_id',
            'resume',
            'id',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-resume_employment_tbl-employments',
            'resume_employment_tbl',
            'employment_id',
            'employments',
            'id',
            'CASCADE',
        );


        $this->createTable('{{%resume_schedule_tbl}}', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'schedule_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-resume_schedule_tbl-resume_id',
            'resume_schedule_tbl',
            'resume_id'
        );

        $this->createIndex(
            'idx-resume_schedule_tbl-schedule_id',
            'resume_schedule_tbl',
            'schedule_id'
        );

        $this->addForeignKey(
            'fk-resume_schedule_tbl-resume',
            'resume_schedule_tbl',
            'resume_id',
            'resume',
            'id',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-resume_schedule_tbl-schedule',
            'resume_schedule_tbl',
            'schedule_id',
            'schedule',
            'id',
            'CASCADE',
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-resume_schedule_tbl-resume',
            'resume_schedule_tbl'
        );
        $this->dropForeignKey(
            'fk-resume_schedule_tbl-schedule',
            'resume_schedule_tbl'
        );

        $this->dropForeignKey(
            'fk-resume_employment_tbl-resume',
            'resume_employment_tbl'
        );

        $this->dropForeignKey(
            'fk-resume_employment_tbl-employments',
            'resume_employment_tbl'
        );

        $this->dropForeignKey(
            'fk-resume-author_id',
            'resume'
        );

        $this->dropForeignKey(
            'fk-resume-specialization_id',
            'resume'
        );

        $this->dropIndex(
            'idx-resume_schedule_tbl-resume_id',
            'resume_schedule_tbl'
        );

        $this->dropIndex(
            'idx-resume_schedule_tbl-schedule_id',
            'resume_schedule_tbl'
        );

        $this->dropIndex(
            'idx-resume_employment_tbl-resume_id',
            'resume_employment_tbl'
        );

        $this->dropIndex(
            'idx-resume_employment_tbl-employment_id',
            'resume_employment_tbl'
        );

        $this->dropIndex(
            'idx-resume-author_id',
            'resume'
        );

        $this->dropIndex(
            'idx-resume-specialization_id',
            'resume'
        );

        $this->dropTable('{{%resume}}');
        $this->dropTable('{{%resume_employment_tbl}}');
        $this->dropTable('{{%resume_schedule_tbl}}');
    }
}
