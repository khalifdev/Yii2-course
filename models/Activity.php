<?php


namespace app\models;


use app\base\BaseModel;
use app\behaviors\DateTimeBehavior;
use yii\db\ActiveRecord;

class Activity extends ActivityBase
{

//    public $isRepeated;
//    public $repeatType;

    const DAY = 0;
    const WEEK = 1;
    const MONTH = 2;
    const REPEAT_TYPE = [self::DAY => 'Каждый день', self::WEEK => 'Каждую неделю',
        self::MONTH => 'Каждый месяц'];

//    public $useNotification;

//    public $repeatEmail;


    public function behaviors()
    {
        return [
            ['class'=>DateTimeBehavior::class,
                'dateTimeFields' => [
                    'startDateTime',
                    'endDateTime',
                    'createdAt',
                    'updatedAt'
                ]
            ],
//            ['class'=>DateTimeBehavior::class, 'dateTime' => 'endDateTime'],
        ];
    }

    public function rules()
    {
        return array_merge([
            [['title', 'email'],'trim'],
//            [['startDateTime', 'endDateTime'], 'string'],
            [['startDateTime', 'endDateTime'], 'date', 'format' => 'php:Y-m-d H:i'],
            ['endDateTime', 'compare', 'compareAttribute' => 'startDateTime', 'operator'=>'>='],
            ['description','string','max' => 300, 'min'=>1],
            [['isBlocked', 'useNotification'],'boolean'],
//            ['repeatType', 'in', 'range' => array_keys(self::REPEAT_TYPE)],
            ['email', 'email'],
            [['email', 'files'] , 'default'],
            ['email', 'required', 'when' => function ($model) {
                return $model->useNotification;
            }],
//            [['email', 'repeatEmail'], 'required', 'when' => function ($model) {
//                return $model->useNotification;
//            }],
//            ['repeatEmail', 'compare', 'compareAttribute' => 'email'],
            [['files'], 'file', 'extensions' => ['jpg', 'png'], 'maxFiles' => 4]
        ],parent::rules());
    }

    public function attributeLabels()
    {
        return [
            'title'=>'Заголовок активности',
            'description'=>'Описание',
            'startDateTime'=>'Время начала',
            'endDateTime'=>'Время окончания',
            'isBlocked'=>'Блокирующая активность',
//            'isRepeated'=>'Повторяющееся',
//            'repeatType'=>'Частота повторения',
            'email'=>'E-mail для оповещения',
//            'repeatEmail'=>'Подтвердите E-mail',
            'useNotification'=>'Оповещать',
            'files'=>'Файлы'
        ];
    }


}