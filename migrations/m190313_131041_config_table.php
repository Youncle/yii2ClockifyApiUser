<?php

use yii\db\Migration;

/**
 * Class m190313_131041_config_table
 */
class m190313_131041_config_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('config', [
            'id' => $this->primaryKey(),
            'owner' => $this->string(100),
            'key' => $this->string(100),
            'value' => $this->string(100),
            'userId' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('config');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190313_131041_config_table cannot be reverted.\n";

        return false;
    }
    */
}
