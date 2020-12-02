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
            'specializations_id' => $this->integer(11)->notNull(),
            'about' => $this->text(),
            'foto' => $this->string()->notNull(),
            'zp' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

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
            'idx-resume-specializations_id',
            'resume',
            'specializations_id'
        );

        $this->addForeignKey(
            'fk-resume-specializations_id',
            'resume',
            'specializations_id',
            'specializations',
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
            'fk-resume-specializations_id',
            'resume'
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
            'idx-resume-specializations_id',
            'resume'
        );

        $this->dropTable('{{%resume}}');
        $this->dropTable('{{%resume_employment_tbl}}');
    }
}
