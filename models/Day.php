<?php


namespace app\models;


use app\base\BaseModel;

class Day extends BaseModel
{
    public $date;   //дата

    public $isDayOff;   // выходной

    public $activities = [];    // записи событий дня

    const DAY = 0;
    const WEEK = 1;
    const MONTH = 2;
    const REPEAT_TYPE = [self::DAY => 'Каждый день', self::WEEK => 'Каждую неделю',
        self::MONTH => 'Каждый месяц'];

    public function __construct($config = [])
    {

        $this->date = date('d.m.Y');

        $this->isDayOff = false;

        $this->activities[] = [
            'title' => 'Купить книгу',
            'description' => 'Надо пойти в книжный магазин, чтобы купить книгу',
            'startTime' => date('H:i'),
            'endTime' => date('H:i'),
            'isBlocking' => true,
            'isRepeated' => true,
            'repeatType' => self::WEEK
        ];

        parent::__construct($config);
    }

}