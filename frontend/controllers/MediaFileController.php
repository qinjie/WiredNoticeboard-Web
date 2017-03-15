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
            $demo = uniqid($model->user_id . "_");
            if ($model->isVideo())
                $model->duration = gmdate("H:i:s", $model->duration);
            else
                $model->duration = gmdate("H:i:s", 1);
            $model->file_path = 'uploads/'.$demo.'.'.$model->file->extension;
            $model->file->saveAs($model->file_path);
//            var_dump($this->getDuration($model->file_path));
//            return;
            if ($model->isVideo()){
                $model->width = 640;
                $model->height = 480;
            }
            else {
                $model->width = getimagesize($model->file_path)[0];
                $model->height = getimagesize($model->file_path)[1];
            }
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
                $demo = uniqid($model->user_id . "_");
                if ($model->isVideo())
                    $model->duration = gmdate("H:i:s", $model->duration);
                else
                    $model->duration = gmdate("H:i:s", 1);
                $model->file_path = 'uploads/'.$demo.'.'.$model->file->extension;
                $model->file->saveAs($model->file_path);
                if ($model->isVideo()){
                    $model->width = 640;
                    $model->height = 480;

                }
                else {
                    $model->width = getimagesize($model->file_path)[0];
                    $model->height = getimagesize($model->file_path)[1];
                }
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
    private function makeThumbnails($imgName)
    {
        $uploadsPath = "uploads/";
        $imgPath = $uploadsPath.$imgName;
        $thumb_before_word = "thumbnail_";
        $arr_image_details = getimagesize($imgPath);
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];
        if ($original_width > 2*$original_height) {
            $thumbnail_width = 200;
            $thumbnail_height = intval($original_height*200/$original_width);
        } else {
            $thumbnail_height = 100;
            $thumbnail_width = intval($original_width*100/$original_height);
        }
        if ($arr_image_details[2] == 1) {
            $imgt = "imagegif";
            $imgcreatefrom = "imagecreatefromgif";
        }
        if ($arr_image_details[2] == 2) {
            $imgt = "imagejpeg";
            $imgcreatefrom = "imagecreatefromjpeg";
        }
        if ($arr_image_details[2] == 3) {
            $imgt = "imagepng";
            $imgcreatefrom = "imagecreatefrompng";
        }
        if ($imgt) {
            $old_image = $imgcreatefrom($imgPath);
            $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
            imagealphablending( $new_image, false );
            imagesavealpha( $new_image, true );
            imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $original_width, $original_height);
            $imgt($new_image, $uploadsPath.$thumb_before_word.$imgName);
        }
    }

    function getDuration($file){
        if (file_exists($file)){
            ## open and read video file
            $handle = fopen($file, "r");
## read video file size
            $contents = fread($handle, filesize($file));
            fclose($handle);
            $make_hexa = hexdec(bin2hex(substr($contents,strlen($contents)-3)));

//            if (strlen($contents) > $make_hexa){
                $pre_duration = hexdec(bin2hex(substr($contents,strlen($contents)-$make_hexa,3))) ;
                $post_duration = $pre_duration/1000;
                $timehours = $post_duration/3600;
                $timeminutes =($post_duration % 3600)/60;
                $timeseconds = ($post_duration % 3600) % 60;
                $timehours = explode(".", $timehours);
                $timeminutes = explode(".", $timeminutes);
                $timeseconds = explode(".", $timeseconds);
                $duration = $timehours[0]. ":" . $timeminutes[0]. ":" . $timeseconds[0];}
            return $duration;
//        }
//        else {
//            return false;
//        }
    }

}
