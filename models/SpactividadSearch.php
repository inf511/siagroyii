<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Spactividad;

/**
 * SpactividadSearch represents the model behind the search form about `app\models\Spactividad`.
 */
class SpactividadSearch extends Spactividad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pkActividad', 'fkOrdenTrabajo'], 'integer'],
            [['codigo', 'descripcion'], 'safe'],
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
        $query = Spactividad::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pkActividad' => $this->pkActividad,
            'fkOrdenTrabajo' => $this->fkOrdenTrabajo,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
