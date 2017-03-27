<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device_token".
 *
 * @property integer $id
 * @property integer $device_id
 * @property string $token
 * @property string $label
 * @property string $mac_address
 * @property string $expire
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
            [['device_id'], 'required'],
            [['device_id'], 'integer'],
            [['expire', 'created_at'], 'safe'],
            [['token', 'mac_address'], 'string', 'max' => 32],
            [['label'], 'string', 'max' => 20],
            [['token'], 'unique'],
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
            'label' => 'Label',
            'mac_address' => 'Mac Address',
            'expire' => 'Expire',
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
