<?php
/**
 * Created by PhpStorm.
 * User: tungphung
 * Date: 3/3/17
 * Time: 9:21 AM
 */

namespace api\modules\v1\controllers;


use api\components\CustomActiveController;
use common\components\AccessRule;
use common\components\TokenHelper;
use common\models\Device;
use common\models\UserToken;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\web\UnauthorizedHttpException;

class DeviceController extends CustomActiveController
{
    public $modelClass = 'api\common\models\Device';

    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'except' => ['get-device'],
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
                ],
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
    public function actionGetDevice(){
        $request = \Yii::$app->request;
        $bodyParams = $request->bodyParams;
        $token = $bodyParams['token'];
        $model = Device::findOne(['token' => $token]);
        if (!$model){
            return -1;
        }
//        $device = Device::findOne($model->device_id);
        UserToken::deleteAll(['user_id' => $model->user_id]);
        $token = TokenHelper::createUserToken($model->user_id);
        return [
            'user_id' => $model->user_id,
            'device_id' => $model->id,
            'token' => $token->token,
        ];
//        return $model->device_id;
    }

}