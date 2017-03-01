<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device_media".
 *
 * @property integer $id
 * @property integer $device_id
 * @property integer $media_file_id
 * @property integer $sequence
 * @property integer $iteration
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Device $device
 * @property MediaFile $mediaFile
 */
class DeviceMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id', 'media_file_id', 'iteration'], 'required'],
            [['device_id', 'media_file_id', 'sequence', 'iteration'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['media_file_id'], 'exist', 'skipOnError' => true, 'targetClass' => MediaFile::className(), 'targetAttribute' => ['media_file_id' => 'id']],
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
            'media_file_id' => 'Media File ID',
            'sequence' => 'Sequence',
            'iteration' => 'Iteration',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMediaFile()
    {
        return $this->hasOne(MediaFile::className(), ['id' => 'media_file_id']);
    }
}
