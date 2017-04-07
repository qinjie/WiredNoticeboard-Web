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
 * @property string $turn_on_time
 * @property string $turn_off_time
 * @property string $slide_timing
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property DeviceMedia[] $deviceMedia
 * @property DeviceToken[] $deviceTokens
 * @property MediaFile[] $playlist
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
            [['user_id', 'slide_timing'], 'integer'],
            [['mac'], 'string'],
            [['created_at', 'updated_at', 'turn_on_time', 'turn_off_time'], 'safe'],
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
            'turn_on_time' => 'Turn On Time',
            'turn_off_time' => 'Turn Off Time',
            'slide_timing' => 'Slide Timing',
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

    public function getMedia()
    {
        return $this->hasMany(MediaFile::className(), ['id' => 'media_file_id'])
            ->viaTable('device_media', ['device_id' => 'id']);
    }

    public function getPlaylist()
    {
        // @ActiveQuery
        $query = MediaFile::find();
        $query->multiple = true;
        $query->innerJoin('device_media', 'device_media.media_file_id=media_file.id');
        $query->andWhere(['device_media.device_id' => $this->id]);
        $query->orderBy('device_media.sequence');
        return $query;
    }
}
