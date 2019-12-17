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
     * @param Activity[] $activity
     */
    public function sendNotifications(array $activity)
    {
        foreach ($activity as $item){
            $send=$this->getMailer()->compose('notif',['model'=>$item])
                ->setSubject('Активность '.$item->id.' стартует сегодня')
                ->setTo($item->email)
                ->send();

            if(!$send){
                if(\Yii::$app instanceof Application){
                    echo 'Error email send '.$item->email;
                }
                return false;
            }

            if(\Yii::$app instanceof Application){
                echo 'Email send '.$item->email.PHP_EOL;
            }
        }
    }
}