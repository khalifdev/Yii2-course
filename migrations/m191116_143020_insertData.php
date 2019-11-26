<?php

use yii\db\Migration;

/**
 * Class m191116_143020_insertData
 */
class m191116_143020_insertData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',[
            'id'=>1,
            'email'=>'test@test.ru',
            'passwordHash'=>'1',
        ]);
        $this->insert('users',[
            'id'=>2,
            'email'=>'test2@test.ru',
            'passwordHash'=>'1',
        ]);

        $this->batchInsert('activity',[
            'title','description','startDateTime','endDateTime','isBlocked','userId'
        ],[
            ['title1','test_desc', date('Y-m-d H:i'), date('Y-m-d H:i'),0,1],
            ['title2','test_desc', date('Y-m-d H:i'), date('Y-m-d H:i'),1,1],
            ['title3','test_desc', date('Y-m-d H:i'), date('Y-m-d H:i'),1,1],
            ['title4','test_desc', date('Y-m-d H:i'), date('Y-m-d H:i'),0,2]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('activity');
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191116_143020_insertData cannot be reverted.\n";

        return false;
    }
    */
}
