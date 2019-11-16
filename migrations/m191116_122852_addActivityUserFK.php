<?php

use yii\db\Migration;

/**
 * Class m191116_122852_addActivityUserFK
 */
class m191116_122852_addActivityUserFK extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('activityUSerFK','activity','userID',
            'users','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('activityUSerFK','activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191116_122852_addActivityUserFK cannot be reverted.\n";

        return false;
    }
    */
}
