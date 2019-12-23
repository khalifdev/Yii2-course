<?php

namespace app\controllers;

use app\base\BaseController;
use app\components\ActivityFilesComponent;
use app\models\Activity;
use app\models\Calendar;
use Yii;
use yii\base\Exception;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * CalendarController implements the CRUD actions for Activity model.
 */
class CalendarController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'user'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Calendar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Activity model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        // проверка прав пользователя
        if(!Yii::$app->rbac->canViewActivity($model)){
            throw new HttpException(403,'Доступ запрещён!');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Activity();

        // если приходит заполненная форма
        if ($model->load(Yii::$app->request->post())) {

            // если запрос асинхронный, возвращаем отвалидированную форму
            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            // извлекаем пользователя
            $model->userId=\Yii::$app->user->getIdentity()->id;

            // обработка файлов
            $model->files = UploadedFile::getInstances($model, 'files');
            if (!ActivityFilesComponent::addFiles($model)) {
                throw new Exception('Ошибка сохранения файлов!', 500);
            }

            // сохранение Активности
            if (!$model->save()) {
                throw new Exception('Ошибка добавления активности!', 500);
            }

            // редирект, если всё нормально
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Activity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // проверка прав пользователя
        if(!Yii::$app->rbac->canViewActivity($model)){
            throw new HttpException(403,'Доступ запрещён!');
        }

        if ($model->load(Yii::$app->request->post())) {

            // если запрос асинхронный, возвращаем отвалидированную форму
            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            // обработка файлов
            $model->files = UploadedFile::getInstances($model, 'files');
            if (!ActivityFilesComponent::addFiles($model)) {
                throw new Exception('Ошибка сохранения файлов!', 500);
            }

            // сохранение Активности
            if (!$model->save()) {
                throw new Exception('Ошибка обновления активности!', 500);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Activity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // проверка прав пользователя
        if(!Yii::$app->rbac->canViewActivity($model)){
            throw new HttpException(403,'Доступ запрещён!');
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница отсутствует.');
    }
}
