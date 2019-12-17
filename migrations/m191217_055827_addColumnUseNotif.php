<?php

use yii\db\Migration;

/**
 * Class m191217_055827_addColumnUseNotif
 */
class m191217_055827_addColumnUseNotif extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity','useNotification',$this->boolean()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('activity','useNotification');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191217_055827_addColumnUseNotif cannot be reverted.\n";

        return false;
    }
    */
}
