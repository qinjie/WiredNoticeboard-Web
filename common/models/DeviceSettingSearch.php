<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DeviceSetting;

/**
 * DeviceSettingSearch represents the model behind the search form about `common\models\DeviceSetting`.
 */
class DeviceSettingSearch extends DeviceSetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'device_id'], 'integer'],
            [['turn_on_time', 'turn_off_time', 'slide_timing'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DeviceSetting::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'device_id' => $this->device_id,
            'turn_on_time' => $this->turn_on_time,
            'turn_off_time' => $this->turn_off_time,
            'slide_timing' => $this->slide_timing,
        ]);

        return $dataProvider;
    }
}
