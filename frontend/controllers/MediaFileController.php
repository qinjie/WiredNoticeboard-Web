<?php

namespace frontend\controllers;

use common\components\AccessRule;
use common\models\User;
use Yii;
use common\models\MediaFile;
use common\models\MediaFileSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MediaFileController implements the CRUD actions for MediaFile model.
 */
class MediaFileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MediaFile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MediaFileSearch();
        if (Yii::$app->user->identity->role == User::ROLE_ADMIN) {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        else {
            $dataProvider = $searchModel->NewSearch(Yii::$app->request->queryParams, Yii::$app->user->id);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MediaFile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->id == $model->user_id  || Yii::$app->user->identity->role == User::ROLE_ADMIN){
            return $this->render('view', [
                'model' => $model,
            ]);
        }
        else {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }

    }

    /**
     * Creates a new MediaFile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MediaFile();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->identity->getId();
            $model->extension = $model->file->extension;
//            if(!is_dir('uploads/'.$model->user_id.'/')) mkdir('uploads/'.$model->user_id.'/');
            $demo = uniqid($model->user_id . "_");
            $model->file_path = 'uploads/'.$demo.'.'.$model->file->extension;
//            $model->file_path = 'uploads/'.$model->user_id.'/'.$demo.'.'.$model->file->extension;
            $model->file->saveAs($model->file_path);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MediaFile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->user->id == $model->user_id  || Yii::$app->user->identity->role == User::ROLE_ADMIN){
            if ($model->load(Yii::$app->request->post()) ) {
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->user_id = Yii::$app->user->identity->getId();
                $model->extension = $model->file->extension;
//            if(!is_dir('uploads/'.$model->user_id.'/')) mkdir('uploads/'.$model->user_id.'/');
                $demo = uniqid($model->user_id . "_");
                $model->file_path = 'uploads/'.$demo.'.'.$model->file->extension;
//            $model->file_path = 'uploads/'.$model->user_id.'/'.$demo.'.'.$model->file->extension;
                $model->file->saveAs($model->file_path);
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }

    }

    /**
     * Deletes an existing MediaFile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->id == $model->user_id  || Yii::$app->user->identity->role == User::ROLE_ADMIN){
            $model->delete();
            return $this->redirect(['index']);
        }
        else {
            throw new ForbiddenHttpException('You are not allowed to delete this article.');
        }
    }

    /**
     * Finds the MediaFile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MediaFile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MediaFile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
