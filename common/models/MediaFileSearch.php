<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MediaFile;

/**
 * MediaFileSearch represents the model behind the search form about `common\models\MediaFile`.
 */
class MediaFileSearch extends MediaFile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'duration', 'width', 'height', 'user_id'], 'integer'],
            [['name', 'extension', 'file_path', 'created_at', 'updated_at'], 'safe'],
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
        $query = MediaFile::find();

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
            'duration' => $this->duration,
            'width' => $this->width,
            'height' => $this->height,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'file_path', $this->file_path]);

        return $dataProvider;
    }
}
