<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\City;

/**
 * CitySearch represents the model behind the search form about `frontend\models\City`.
 */
class CitySearch extends City
{
    public $area;
    public $province;
    public $city;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area'], 'required', 'when' => function($model) {
                $provinceValue = $model->province;
                $provinceIsEmpty = $provinceValue === null || $provinceValue === [] || $provinceValue === '';
                $cityValue = $model->city;
                $cityIsEmpty = $cityValue === null || $cityValue === [] || $cityValue === '';
                return !$provinceIsEmpty || !$cityIsEmpty;
            }, 'whenClient' => "function(attribute, value){
                return $('#profile-province').val() || $('#profile-city').val();
            }"],
            [['province', 'city', 'area'], 'integer'],
            [['id', 'parent_id', 'sort', 'deep'], 'integer'],
            [['name'], 'safe'],
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
        $query = City::find();

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
            'parent_id' => $this->parent_id,
            'sort' => $this->sort,
            'deep' => $this->deep,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
