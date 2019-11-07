<?php


namespace app\models;


use app\base\BaseModel;

class Day extends BaseModel
{
    public $date;   //дата

    public $isDayOff;   // выходной

    public $activities = [];    // записи событий дня

    public function __construct($config = [])
    {

        $this->date = date('F j, y');

        $this->isDayOff = false;

        $this->activities[] = [
            'title' => 'Купить книгу',
            'description' => 'Надо пойти в книжный магазин, чтобы купить книгу',
            'isBlocked' => true,
            'isRepeat' => false
        ];

        parent::__construct($config);
    }

}