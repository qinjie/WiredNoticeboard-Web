<?php
/**
 * Created by PhpStorm.
 * User: tungphung
 * Date: 3/3/17
 * Time: 9:21 AM
 */

namespace api\modules\v1\controllers;


use api\common\controllers\CustomActiveController;
use common\components\AccessRule;
use common\components\TokenHelper;
use common\models\Device;
use common\models\DeviceToken;
use common\models\UserToken;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\web\UnauthorizedHttpException;

class NodeController extends CustomActiveController
{
    public $modelClass = 'api\common\models\Device';

    // Remove all default Restful actions
    public function actions()
    {
        return [];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        # Use custom authentication through device-token
        $behaviors['authenticator']['except'] = [
            'enroll', 'playlist', 'download-file'
        ];

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'ruleConfig' => [
                'class' => AccessRule::className(),
            ],
            'rules' => [
                [
                    'actions' => ['enroll', 'playlist', 'download-file'],
                    'allow' => true,
                    'roles' => ['?'],
                ],
            ],
            'denyCallback' => function ($rule, $action) {
                throw new UnauthorizedHttpException('You are not authorized');
            },
        ];

        return $behaviors;
    }

    public function actionEnroll()
    {
        $request = \Yii::$app->request;
        $bodyParams = $request->bodyParams;
        $token = $bodyParams['mac'];
        $model = Device::findOne(['mac' => $token]);
        if (!$model) {
            throw new UnauthorizedHttpException('You are not authorized');
        }
        DeviceToken::deleteAll(['device_id' => $model->id]);
        $token = TokenHelper::createDeviceToken($model->id);
        return [
            'user_id' => $model->user_id,
            'device_id' => $model->id,
            'token' => $token->token,
        ];
    }

    public function actionPlaylist()
    {
        $request = \Yii::$app->request;
        $bodyParams = $request->bodyParams;
        $token = $bodyParams['token'];
        $model = DeviceToken::findOne(['token' => $token]);
        if (!$model) {
            throw new UnauthorizedHttpException('You are not authorized');
        }
        return $model->device->playlist;
    }

    public function actionDownloadFile($filename)
    {
        $request = \Yii::$app->request;
        $bodyParams = $request->bodyParams;
        $token = $bodyParams['token'];
        $model = DeviceToken::findOne(['token' => $token]);
        if (!$model) {
            throw new UnauthorizedHttpException('You are not authorized');
        }

        $folder = Yii::getAlias('@uploads');
        $path = $folder . '/' . $filename;
        if (file_exists($path)) {
            Yii::$app->response->SendFile($path, $filename);
        } else {
            throw new HttpException(404, 'The requested item could not be found.');
        }
    }
}