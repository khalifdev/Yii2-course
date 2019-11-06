<?php


namespace app\components;


use app\base\BaseComponent;

class DayComponent extends BaseComponent
{

    public $modelClass;

    public function init()
    {
        parent::init();

    }

    public function getModel()
    {
        return new $this->modelClass;
    }
}