<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device_token".
 *
 * @property integer $id
 * @property integer $device_id
 * @property string $token
 * @property string $created_at
 *
 * @property Device $device
 */
class DeviceToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id', 'token'], 'required'],
            [['device_id'], 'integer'],
            [['created_at'], 'safe'],
            [['token'], 'string', 'max' => 32],
            [['device_id', 'token'], 'unique', 'targetAttribute' => ['device_id', 'token'], 'message' => 'The combination of Device ID and Token has already been taken.'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_id' => 'Device ID',
            'token' => 'Token',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }
}
