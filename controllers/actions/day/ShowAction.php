<?php


namespace app\controllers\actions\day;


use app\base\BaseAction;

class ShowAction extends BaseAction
{

    public function run()
    {

        $model = \Yii::$app->day->getModel();

//        $model->load([
//            'date' => date('F j, y'),
//            'isDayOff' => true,
//            'activities' => [
//                'title' => 'Купить книгу',
//                'description' => 'Надо пойти в книжный магазин, чтобы купить книгу',
//                'isBlocked' => true,
//                'isRepeat' => false
//            ]
//        ]);

        return $this->controller->render('show', ['model' => $model]);

    }
}