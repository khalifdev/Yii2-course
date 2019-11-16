<?php

use yii\db\Migration;

/**
 * Class m191116_115648_createTableActivity
 */
class m191116_115648_createTableActivity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(150)->notNull(),
            'description'=>$this->text()->notNull(),
            'files'=>$this->string(600),
            'startDateTime'=>$this->dateTime()->notNull(),
            'endDateTime'=>$this->dateTime()->notNull(),
            'isBlocked'=>$this->boolean()->notNull()->defaultValue(0),
            'email'=>$this->string('150'),
            'createdAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt'=>$this->dateTime(),
            'userId'=>$this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191116_115648_createTableActivity cannot be reverted.\n";

        return false;
    }
    */
}
