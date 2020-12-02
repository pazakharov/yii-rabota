<?php

use yii\db\Migration;

/**
 * Class m201202_104135_baseTestData
 */
class m201202_104135_baseTestData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents(__DIR__ . '/sql/baseUp.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo '####################';
        print_r($this->execute(file_get_contents(__DIR__ . '/sql/baseDown.sql')));
        echo '####################';
        return true;
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201202_104135_baseTestData cannot be reverted.\n";

        return false;
    }
    */
}
