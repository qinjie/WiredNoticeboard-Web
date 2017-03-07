<?php
/**
 * Created by PhpStorm.
 * User: tungphung
 * Date: 7/3/17
 * Time: 3:10 PM
 */

namespace api\modules\v1\controllers;


use api\common\models\DeviceToken;
use api\components\CustomActiveController;
use common\components\TokenHelper;
use common\models\Device;
use common\models\UserToken;
use Yii;

class DeviceTokenController extends CustomActiveController
{
    public $modelClass = 'api\common\models\DeviceToken';

    public function actionGetDevice(){
        $request = Yii::$app->request;
        $bodyParams = $request->bodyParams;
        $token = $bodyParams['token'];
        $model = DeviceToken::findOne(['token' => $token]);
        if (!$model){
            return -1;
        }
        $device = Device::findOne($model->device_id);
        UserToken::deleteAll(['user_id' => $device->user_id]);
        $token = TokenHelper::createUserToken($device->user_id);
        return [
            'user_id' => $device->user_id,
            'device_id' => $model->device_id,
            'token' => $token->token,
        ];
//        return $model->device_id;
    }
}