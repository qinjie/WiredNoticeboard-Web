<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device_setting".
 *
 * @property integer $id
 * @property integer $device_id
 * @property string $turn_on_time
 * @property string $turn_off_time
 * @property string $slide_timing
 *
 * @property Device $device
 */
class DeviceSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id', 'turn_on_time', 'turn_off_time', 'slide_timing'], 'required'],
            [['device_id'], 'integer'],
            [['turn_on_time', 'turn_off_time', 'slide_timing'], 'safe'],
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
            'turn_on_time' => 'Turn On Time',
            'turn_off_time' => 'Turn Off Time',
            'slide_timing' => 'Slide Timing',
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
