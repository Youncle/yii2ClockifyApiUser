<?php

use yii\db\Migration;

/**
 * Class m190327_151319_documents_update
 */
class m190327_151319_documents_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('documents','extension',$this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('documents','extension');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190327_151319_documents_update cannot be reverted.\n";

        return false;
    }
    */
}
