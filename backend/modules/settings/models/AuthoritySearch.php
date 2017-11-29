<?php

namespace backend\modules\settings\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\settings\models\Authority;

/**
 * AuthoritySearch represents the model behind the search form about `backend\modules\settings\models\Authority`.
 */
class AuthoritySearch extends Authority
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usergroup_id', 'authitem_id', 'is_access', 'postby_id', 'is_verified', 'verifiedby_id', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
        $query = Authority::find();

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
            'usergroup_id' => $this->usergroup_id,
            'authitem_id' => $this->authitem_id,
            'is_access' => $this->is_access,
            'created_at' => $this->created_at,
            'postby_id' => $this->postby_id,
            'is_verified' => $this->is_verified,
            'verifiedby_id' => $this->verifiedby_id,
            'updated_at' => $this->updated_at,
            'is_active' => $this->is_active,
        ]);

        return $dataProvider;
    }
}
