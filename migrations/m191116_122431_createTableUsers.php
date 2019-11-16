<?php

use yii\db\Migration;

/**
 * Class m191116_122431_createTableUsers
 */
class m191116_122431_createTableUsers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'email'=>$this->string(150)->notNull(),
            'passwordHash'=>$this->string(150),
            'authKey'=>$this->string(150),
            'token'=>$this->string(150),
            'createAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191116_122431_createTableUsers cannot be reverted.\n";

        return false;
    }
    */
}
