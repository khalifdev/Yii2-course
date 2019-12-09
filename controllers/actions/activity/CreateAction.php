<?php


namespace app\controllers\actions\activity;


use app\base\BaseAction;
use yii\bootstrap\ActiveForm;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class CreateAction extends BaseAction
{
    public function run()
    {
        if(!\Yii::$app->rbac->canCreateActivity()){
            throw new HttpException(403,'Not Auth Action');
        }

        // получаем экземпляр модели активности
        $model = \Yii::$app->activity->getModel();

        // если передана форма
        if (\Yii::$app->request->isPost) {
            // загружаем данные формы в модель
            $model->load(\Yii::$app->request->post());
            $model->userId=\Yii::$app->user->getIdentity()->id;
            $model->files = UploadedFile::getInstances($model, 'files');

            // если запрос асинхронный, возвращаем отвалидированную форму
            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            // вызываем метод добавления активности
            if(\Yii::$app->activity->addActivity($model)) {
                return $this->controller->redirect(['/activity/view','id'=>$model->id]);

            }
        }

        return $this->controller->render('create', ['model' => $model]);
    }
}