<?php


namespace app\components;


use app\models\Activity;
use yii\base\Component;
use yii\console\Application;

class NotificationComponent extends Component
{
    /** @var MailerInterface */
    private $mailer;

    public function init()
    {
        parent::init();

        $this->mailer=\Yii::$app->mailer;
    }

    public function getMailer(){
        return $this->mailer;
    }


    /**
     * @param Activity[] $activities
     */
    public function sendNotifications(array $activities)
    {
        foreach ($activities as $activity){
            $send=$this->getMailer()->compose('notif',['model'=>$activity])
                ->setSubject('Активность "'.$activity->title.'" стартует сегодня')
                ->setFrom('alex.cojukhov@ya.ru')
                ->setTo($activity->email)
                ->send();

            if(!$send){
                if(\Yii::$app instanceof Application){
                    echo 'Error email send '.$activity->email;
                }
                return false;
            }

            if(\Yii::$app instanceof Application){
                echo 'Email send '.$activity->email.PHP_EOL;
            }
        }
    }
}