<?php

namespace frontend\controllers;

use common\components\AccessRule;
use common\models\DeviceMedia;
use common\models\User;
use Yii;
use common\models\Device;
use common\models\DeviceSearch;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeviceController implements the CRUD actions for Device model.
 */
class DeviceController extends Controller
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
     * Lists all Device models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeviceSearch();
        if (Yii::$app->user->identity->role == User::ROLE_ADMIN){
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        else {
            $dataProvider = $searchModel->newSearch(Yii::$app->request->queryParams, Yii::$app->user->id);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single Device model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->id == $model->user_id  || Yii::$app->user->identity->role == User::ROLE_ADMIN){

            $devic = DeviceMedia::find()->where(['device_id' => $model->id])->orderBy('sequence');
            $device = new ActiveDataProvider([
                'query' => $devic,
                'pagination' => false,
            ]);
    //        var_dump($model);
            return $this->render('view', [
                'device' => $device,
                'model' => $model,
            ]);
        }
        else {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
    }

    /**
     * Creates a new Device model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Device();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->getId();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Device model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->id == $model->user_id  || Yii::$app->user->identity->role == User::ROLE_ADMIN){
            if ($model->load(Yii::$app->request->post())) {
                $model->user_id = Yii::$app->user->identity->getId();
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
     *
     */
    public function actionShow($id){
        $model = $this->findModel($id);
        if (Yii::$app->user->id == $model->user_id  || Yii::$app->user->identity->role == User::ROLE_ADMIN){
            $device = DeviceMedia::find()->where(['device_id' => $model->id])->orderBy('sequence')->all();
            return $this->render('show', [
                'device' => $device,
                'model' => $model,
            ]);
        }
        else {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
    }

    /**
     *
     */
    public function actionSort(){
        $request = Yii::$app->request;
        $bodyParams = $request->bodyParams;
        $id =  $bodyParams['id'];
        $models =  $bodyParams['model'];
        foreach ($models as $value => $item){
            $model = DeviceMedia::findOne($item);
            $model->sequence = $value +1;
            $model->save();
//            $value
        }
        return $this->redirect(['view', 'id' => $id]);
//        var_dump($bodyParams);

    }

    /**
     * Deletes an existing Device model.
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
     * Finds the Device model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Device the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Device::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
