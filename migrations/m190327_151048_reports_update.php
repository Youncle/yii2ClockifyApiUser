<?php

use yii\db\Migration;

/**
 * Class m190327_151048_reports_update
 */
class m190327_151048_reports_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('reports','documents');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('documents','reports');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190327_151048_reports_update cannot be reverted.\n";

        return false;
    }
    */
}
