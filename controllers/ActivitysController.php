<?php

namespace app\controllers;

use app\components\ActivityFilesComponent;
use Yii;
use app\models\Activity;
use app\models\ActivitySearch;
use app\base\BaseController;
use yii\base\Exception;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ActivitysController implements the CRUD actions for Activity model.
 */
class ActivitysController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
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
        $searchModel = new ActivitySearch();
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

            // извлекаем пользователя
            $model->userId=\Yii::$app->user->getIdentity()->id;

            // обработка файлов
            $model->files = UploadedFile::getInstances($model, 'files');
            if (!ActivityFilesComponent::addFiles($model)) {
                throw new Exception('Ошибка сохранения файлов!', 500);
            }

            // сохранение Активности
            if (!$model->save()) {
                print_r($model->attributes);
                exit();
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}