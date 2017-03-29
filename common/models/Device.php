<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property integer $id
 * @property string $name
 * @property string $remark
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property DeviceMedia[] $deviceMedia
 * @property DeviceToken[] $deviceTokens
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user_id', 'mac'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 25],
            [['remark'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'remark' => 'Remark',
            'mac' => 'Serial Number',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceMedia()
    {
        return $this->hasMany(DeviceMedia::className(), ['device_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceTokens()
    {
        return $this->hasMany(DeviceToken::className(), ['device_id' => 'id']);
    }

    public function getMedia(){
        return $this->hasMany(MediaFile::className(),['id' => 'media_file_id'])
            ->viaTable('device_media', ['device_id' => 'id']);
    }
}
