<?php

use yii\db\Migration;

/**
 * Class m191116_123304_addEmailUniqIndex
 */
class m191116_123304_addEmailUniqIndex extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('emailUniqueInd','users','email',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('emailUniqueInd', 'users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191116_123304_addEmailUniqIndex cannot be reverted.\n";

        return false;
    }
    */
}
