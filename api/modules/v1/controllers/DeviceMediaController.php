<?php
/**
 * Created by PhpStorm.
 * User: tungphung
 * Date: 3/3/17
 * Time: 9:21 AM
 */

namespace api\modules\v1\controllers;


use api\common\models\DeviceMedia;
use api\components\CustomActiveController;
use common\components\AccessRule;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\web\UnauthorizedHttpException;

class DeviceMediaController extends CustomActiveController
{
    public $modelClass = 'api\common\models\DeviceMedia';

    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'except' => [],
        ];

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'ruleConfig' => [
                'class' => AccessRule::className(),
            ],
            'rules' => [
                [
                    'actions' => [],
                    'allow' => true,
                    'roles' => ['?'],
                ],
                [
                    'actions' => [],
                    'allow' => true,
                    'roles' => ['@'],
                ]
            ],
            'denyCallback' => function ($rule, $action) {
                throw new UnauthorizedHttpException('You are not authorized');
            },
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
            ],
        ];

        return $behaviors;
    }

    public function actionGetMedia(){
        $request = \Yii::$app->request;
        $bodyParams = $request->bodyParams;
        $device_id = $bodyParams['device_id'];
        $listMedia = DeviceMedia::find()->where(['device_id' => $device_id])->orderBy('sequence')->all();
        $list = [];
        foreach ($listMedia as $value){
            $list [] = $value->mediaFile;
        }
//        return $list;
        return $listMedia;
    }

}