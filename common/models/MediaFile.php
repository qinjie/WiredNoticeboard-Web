<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "media_file".
 *
 * @property integer $id
 * @property string $name
 * @property string $extension
 * @property integer $duration
 * @property integer $width
 * @property integer $height
 * @property string $file_path
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property DeviceMedia[] $deviceMedia
 * @property User $user
 */
class MediaFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;
    public $iteration;

    public static function tableName()
    {
        return 'media_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'extension', 'file_path', 'user_id'], 'required'],
            [['width', 'height', 'user_id'], 'integer'],
            [['created_at', 'updated_at', 'duration'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['extension'], 'string', 'max' => 10],
            [['file_path'], 'string', 'max' => 100],
            [['file'], 'required', 'on'=> 'create'],
//            [['file'], 'file', 'skipOnEmpty' => true],
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
            'extension' => 'Extension',
            'duration' => 'Duration',
            'width' => 'Width',
            'height' => 'Height',
            'file_path' => 'File Path',
            'file' => 'File',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function fields()
    {
        $new = [
            'link' => function ($model) {
                return "http://128.199.93.67/WiredNoticeboard-Web/frontend/web/" . $model->file_path;
            },
        ];
        $fields = array_merge(parent::fields(), $new);
        return $fields;
    }

    /**
     * check if this is a video
     */
    public function isVideo(){
        if ($this->extension == 'mp4') return true;
        return false;

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceMedia()
    {
        return $this->hasMany(DeviceMedia::className(), ['media_file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
