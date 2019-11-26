<?php


namespace app\controllers\actions\activity;


use app\base\BaseAction;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use yii\web\UploadedFile;

class CreateAction extends BaseAction
{
    public function run()
    {
        // получаем экземпляр модели активности
        $model = \Yii::$app->activity->getModel();

        // если передана форма
        if (\Yii::$app->request->isPost) {
            // загружаем данные формы в модель
            $model->load(\Yii::$app->request->post());
            $model->files = UploadedFile::getInstances($model, 'files');

            // если запрос асинхронный, возвращаем отвалидированную форму
            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            // вызываем метод добавления активности
            if(!\Yii::$app->activity->addActivity($model)) {
                print_r($model->getErrors());

            }
            // результат в случае успеха
            else {
                return $this->controller->render('create', ['model' => $model]);
            }
        }

        return $this->controller->render('create', ['model' => $model]);
    }
}