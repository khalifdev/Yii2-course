<?php

use yii\db\Migration;

/**
 * Class m191126_054040_insertUsersForRbac
 */
class m191126_054040_insertUsersForRbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert('users',[
            'id'=>1,
            'email'=>'test@test.ru',
            'passwordHash'=>Yii::$app->security->generatePasswordHash('123456'),
        ]);
        $this->insert('users',[
            'id'=>2,
            'email'=>'test2@test.ru',
            'passwordHash'=>Yii::$app->security->generatePasswordHash('123456'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->delete('users', [
//            'id'=>1,
//        ]);
//        $this->delete('users', [
//            'id'=>2,
//        ]);

        $this->delete('activity');
        $this->delete('users');
    }

}
