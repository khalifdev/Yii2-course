<?php


namespace app\models;


use app\base\BaseModel;

class Activity extends BaseModel
{
    public $title;

    public $description;

    public $date;

    public $isBlocked;

    public $isRepeat;

//    public $errors;

    public function rules()
    {
        return [
            ['title','required'],
            ['description','string','max' => 250],
            ['date','string'],
            [['isBlocked','isRepeat'],'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title'=>'Заголовок события',
            'description'=>'Описание',
            'date'=>'Дата',
            'isBlocked'=>'Блокирующее событие'
        ];
    }


}