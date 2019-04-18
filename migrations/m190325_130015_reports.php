<?php

use yii\db\Migration;

/**
 * Class m190325_130015_reports
 */
class m190325_130015_reports extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reports', [
            'id' => $this->primaryKey(),
            'filename' => $this->string(100),
            'size' => $this->string(100),
            'type' => $this->string(100),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('reports');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190325_130015_reports cannot be reverted.\n";

        return false;
    }
    */
}
